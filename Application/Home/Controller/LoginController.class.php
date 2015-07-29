<?php 
namespace Home\Controller;
use Think\Controller;

// 前台登陆视图
class LoginController extends Controller {

    // 登陆视图
    public function index () {
        $this->display();
    }

    // 登陆表单处理
    public function loginHandle () {
        if (!IS_POST) halt('页面不存在');

        $db = M('user');
        $user = $db->where(array('username'=>I('username')))->find();
        
        if (!$user || $user['password'] != I('password', '', 'md5')) {
            $this->error('账号或密码错误！');
        }

        session('uid', $user['id']);
        session('username', $user['username']);
        session('nickname', $user['nickname']);
        session('role', $user['role']);

        redirect(__MODULE__);
    }

}

?>