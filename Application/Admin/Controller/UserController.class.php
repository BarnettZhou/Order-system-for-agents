<?php 
namespace Admin\Controller;
use Admin\Common\Controller\CommonController;
/**
 * 用户视图
 */
class UserController extends CommonController {

    // 首页视图，查询所有用户信息
    public function index () {
        // 查询非代理用户
        $notAgent['role'] = array('NOT IN', '2');
        $users = M('user')->where($notAgent)->select();
        foreach ($users as &$v) {
            $v['rolename'] = self::userRole($v['role']);
        }

        // 查询代理信息
        $isAgent['role'] = array('IN', '2');
        $agents = M('user')->where($isAgent)->order('id')->select();
        $agents_info = M('agent')->order('id')->select();
        // 拼合agents和agents_info中的数据
        foreach ($agents as $key => &$v) {
            // 检查ID是否相同
            if ($v['id'] == $agents_info[$key]['id']) {
                $v['wechat_id'] = $agents_info[$key]['wechat_id'];
                $v['level'] = $agents_info[$key]['level'];
                $v['auth_time'] = $agents_info[$key]['auth_time'];
                $v['account'] = $agents_info[$key]['account'];
            } else {
                $this->error('系统遇到错误，请联系网站管理员', U(MODUAL_NAME.'/Index'));
            }
        }
        /**
         * +------------------------------+
         * | 以上功能后期使用视图模型完成 |
         * +------------------------------+
         * | 当然了，只是个计划而已……………… |
         * +------------------------------+
         */

        $this->users = $users;
        $this->agents = $agents;
        $this->display();
    }

    // 添加用户
    public function addUser () {
        $this->display();
    }

    // 添加用户表单处理
    public function addUserHandle () {
        // 添加至user表
        $user = array(
                'username' => I('username'),
                'password' => I('password', null, 'md5'),
                'nickname' => I('nickname'),
                'role'     => I('role', 4, 'intval')
                );
        $id = M('user')->add($user);
        if (!$id) {
            $this->error('用户添加失败');
        } else {
            // 若添加成功且用户角色为代理，插入agent表
            if ($_POST['role'] == 2) {
                $agent = array(
                    'id'        => $id,
                    'wechat_id' => I('wechat_id'),
                    'level'     => I('level', 0, 'intval'),
                    'auth_time' => strtotime(I('auth_time')),
                    'account'   => I('account', 0, 'intval')
                    );
                if (!M('agent')->add($agent)) {
                    $this->error('添加代理信息失败');
                }
            }
        }

        $this->success('用户添加成功', U(MODULE_NAME.'/User/index'));
    }

    // 修改用户信息
    public function alterUser () {
        #To do...
        p($_GET);
    }

    // 修改用户信息表单处理
    public function alterUserHandle () {
        #To do...
        p($_POST);
    }

    // 修改代理的账户信息
    public function changeAccount () {
        $user = $_GET;
        $arr = M('agent')->where(array('id' => $user['aid']))->find();
        $user['last_account'] = $arr['account'];
        p($user);

        $this->user = $user;
        $this->display();
    }

    // 修改代理账户信息表单处理
    public function changeAccountHandle() {
        $aid = I('aid', 0, 'intval');
        $agent = array();
        $arr = array(
            'aid'     => $aid,
            'mid'     => $_SESSION['uid'],
            'time'    => time(),
            'operate' => I('operate', 1, 'intval'),
            'amount'  => I('amount', 0, 'intval'),
            'remark'  => $_POST['remark'],
            'last_account' => I('last_account', 0, 'floatval')
            );

        if ($arr['operate']) {
            $new_account = $arr['last_account'] + $arr['amount'];
        } else {
            $new_account = $arr['last_account'] - $arr['amount'];
        }

        $arr['new_account'] = $new_account;
        $agent['account'] = $new_account;

        if (M('account')->add($arr) && M('agent')->where('id='.$aid)->save($agent)) {
            $this->success('修改代理账户成功', U(MODULE_NAME.'/User/index'));
        } else {
            $this->error('修改代理账户失败');
        }
    }

    // 修改密码
    public function changePwd () {
        $this->user = $_GET;
        $this->display();
    }

    // 修改密码表单处理
    public function changePwdHandle () {
        $id = I('id', 0, 'intval');
        $old_pwd = I('old_pwd', null, 'md5');
        $new_pwd = I('new_pwd', null, 'md5');

        $db = M('user');
        $where = array('id' => $id);
        $info = $db->where($where)->field(array('password'))->find();
        if ($info['password'] == $old_pwd) {
            $new_info = array('password' => $new_pwd);
            if ($db->where($where)->save($new_info)) {
                $this->success('密码修改成功', U(MODULE_NAME.'/User/index'));
            } else {
                $this->error('修改失败');
            }
        } else {
            $this->error('原密码错误');
        }
    }

    // 判断用户角色函数
    static public function userRole ($role) {
        switch ($role) {
            case 0:
                $rolename = '超级管理员';
                break;
            case 1:
                $rolename = '普通管理员';
                break;
            case 2:
                $rolename = '代理';
                break;
            case 3:
                $rolename = '失效代理';
                break;
            default:
                $rolename = '无效用户';
        }

        return $rolename;
    }

}

?>