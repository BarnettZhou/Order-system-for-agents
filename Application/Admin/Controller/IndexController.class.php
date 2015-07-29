<?php
namespace Admin\Controller;
use Admin\Common\Controller\CommonController;

class IndexController extends CommonController {

    // 后台首页
    public function index (){
        $userinfo = M('user')->where(array('id' => $_SESSION['uid']))->find();
        $userinfo['rolename'] = UserController::userRole($userinfo['role']);

        $this->userinfo = $userinfo;
        $this->display();
    }

    // 退出登陆
    public function logout () {
        session_unset();
        session_destroy();
        $this->redirect(MODULE_NAME.'/Login/index');
    }
}