<?php 
namespace Home\Controller;
use Home\Common\Controller\CommonController;
/**
 * 商品视图
 */
class ProductController extends CommonController {

    public function index () {
        $this->cate = M('cate')->select();
        $this->products = M('product')->limit(5)->order('time DESC')->select();

        $this->display();
    }

    public function showByCate () {
        $cid = I('cid', 0, 'intval');
        $db = M('product');

        // 分页设置
        $count = $db->where('cid='.$cid)->count();
        $Page = new \Think\Page($count, 10);
        $show = $Page->show();

        $this->cate = I('cateTitle');
        $this->products = M('product')->where('cid='.$cid)->order('time DESC')->limit($Page->firstRow.','.$Page->listRows)->select();
        $this->page = $show;
        $this->display();
    }

}
?>