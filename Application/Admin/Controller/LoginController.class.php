<?php 
namespace Admin\Controller;
use Think\Controller;

class LoginController extends Controller {

    // 登陆首页
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

        if ($user['role'] > 1) {
            $this->error('您无权登陆管理页面！');
        }

        session('uid', $user['id']);
        session('username', $user['username']);
        session('role', $user['role']);

        redirect(__MODULE__);
    }

}

?>