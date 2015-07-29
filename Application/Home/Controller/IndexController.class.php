<?php
namespace Home\Controller;
use Home\Common\Controller\CommonController;
/**
 * 前台所有涉及用户的查询都需使用$_SESSION变量
 */
class IndexController extends CommonController {
    
    public function index(){
        $userinfo = M('user')->where(array('id' => $_SESSION['uid']))->find();
        $agent = M('agent')->where('id='.$userinfo['id'])->find();

        $this->userinfo = $userinfo;
        $this->agent = $agent;
        $this->display();
    }

    // 退出登陆
    public function logout () {
        session_unset();
        session_destroy();
        $this->redirect(MODULE_NAME.'/Login/index');
    }

}