<?php 
namespace Admin\Common\Controller;
use Think\Controller;
class CommonController extends Controller {

    public function _initialize () {
        if (!isset($_SESSION['uid']) || $_SESSION['role'] > 1) {
            $this->redirect(MODULE_NAME.'/Login/index');
        }
    }

}
?>