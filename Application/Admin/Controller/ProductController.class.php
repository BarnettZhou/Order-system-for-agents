<?php 
namespace Admin\Controller;
use Admin\Common\Controller\CommonController;
/**
 * 商品控制器
 */
class ProductController extends CommonController {

    // 商品视图首页
    public function index () {
        $db = M('product');

        // 分页设置
        $count = $db->count();
        $Page = new \Think\Page($count, 10);
        $show = $Page->show();

        $this->products = M('product')->limit($Page->firstRow.','.$Page->listRows)->select();
        $this->page = $show;
        $this->display();
    }

    // 添加商品视图
    public function addProduct() {
        $this->cate = M('cate')->select();
        $this->display();
    }

    // 添加商品表单处理
    public function addProductHandle () {
        $product_info = $_POST;

        // 若图片名不为空，则上传图片并插入商品信息
        if (!empty($_FILES['image']['name'])) {
            $upload_info = self::upload();
            if (!$upload_info) {
                $this->error('图片上传失败');
            } else {
                $imageURL = './Uploads/'.$upload_info['image']['savepath'].$upload_info['image']['savename'];
                $product_info['image'] = $imageURL;
                if (M('Product')->add($product_info)) {
                    $this->success('添加商品成功', U(MODULE_NAME.'/Product/index'));
                } else {
                    $this->error('添加商品失败');
                }
            }
        // 图片为空，直接插入商品信息
        } else {
            if (M('product')->add($product_info)) {
                $this->success('添加商品成功', U(MODULE_NAME.'/Product/index'));
            } else {
                $this->error('添加商品失败');
            }
        }
    }

    // 上传方法
    private function upload () {
        $config = array(
            'maxSize'    =>    3145728,
            'rootPath'   =>    './Uploads/',
            'savePath'   =>    '',
            'saveName'   =>    'time',
            'exts'       =>    array('jpg', 'gif', 'png', 'jpeg'),
            'autoSub'    =>    true,
            'subName'    =>    array('date','Ymd'),
        );

        $upload = new \Think\Upload();
        $info   =   $upload->upload();
        return $info;
    }

    // 修改商品信息
    public function alterProduct () {
        $info = M('product')->where($_GET)->find();

        $this->cate = M('cate')->select();
        $this->product = $info;
        $this->display();
    }

    // 修改商品信息表单处理
    public function alterProductHandle () {
        // p($_POST);
        // p($_FILES);
        $product_info = $_POST;

        // 若图片名不为空，则上传图片并修改商品信息
        // to do: 若图片存在，需要删除原有图片
        if (!empty($_FILES['image']['name'])) {
            $upload_info = self::upload();
            if (!$upload_info) {
                $this->error('图片上传失败');
            } else {
                $imageURL = './Uploads/'.$upload_info['image']['savepath'].$upload_info['image']['savename'];
                $product_info['image'] = $imageURL;
                if (M('Product')->where(array('id' => $product_info['id']))->save($product_info)) {
                    $this->success('修改商品成功', U(MODULE_NAME.'/Product/index'));
                } else {
                    $this->error('修改商品失败');
                }
            }
        // 图片为空，直接修改商品信息
        } else {
            if (M('product')->where(array('id' => $product_info['id']))->save($product_info)) {
                $this->success('修改商品成功', U(MODULE_NAME.'/Product/index'));
            } else {
                $this->error('修改商品失败');
            }
        }
    }

    // 更改商品库存
    public function changeRemainder () {
        $this->product = M('product')->where($_GET)->find();
        $this->display();
    }

    // 更改商品库存表单处理
    public function changeRemainderHandle() {
        $info = $_POST;
        $info['uid'] = $_SESSION['uid'];
        $remainder = M('product')->where(array('id' => $info['pid']))->field(array('remainder'))->find();

        $last = $remainder['remainder'];
        if ($info['operate']) {
            $new = $last + $info['num'];
        } else {
            $new = $last - $info['num'];
        }
        $info['last_remainder'] = $last;
        $info['new_remainder'] = $new;
        $remainder['remainder'] = $new;
        
        // p($info);
        // p($remainder);

        if (M('remainder')->add($info) && M('product')->where(array('id' => $info['pid']))->save($remainder)) {
            $this->success('更改成功', U(MODULE_NAME.'/Product/index'));
        } else {
            $this->error('更改失败');
        }
    }

}

?>