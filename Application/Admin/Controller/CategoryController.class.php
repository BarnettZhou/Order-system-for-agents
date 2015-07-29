<?php 
namespace Admin\Controller;
use Admin\Common\Controller\CommonController;

class CategoryController extends CommonController {

    public function index () {
        $this->cate = M('cate')->select();
        // p($cate);die;
        $this->display();
    }

    public function addCate () {
        $this->pid = I('pid', 0, 'intval');
        $this->display();
    }

    public function addCateHandle () {
        // p($_POST);die;
        if (M('cate')->add($_POST)) {
            $this->success('添加分类成功', U(MODULE_NAME.'/Category/index'));
        } else {
            $this->error('添加失败');
        }
    }

    public function alterCate () {
        $this->cate = $_GET;
        $this->display();
    }

    public function alterCateHandle () {
        // p($_POST);die;
        if (M('cate')->where(array('id' => I('id', null, 'intval')))->save($_POST)) {
            $this->success('修改成功', U(MODULE_NAME.'/Category/index'));
        } else {
            $this->error('修改失败');
        }
    }

}

?>