<?php 
namespace Home\Common\Controller;
use Think\Controller;

// 前台公共控制器
class CommonController extends Controller {

    public function _initialize () {
        if (!isset($_SESSION['uid'])) {
            $this->redirect(MODULE_NAME.'/Login/index');
        }
    }

}

?>