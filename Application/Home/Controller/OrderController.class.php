<?php 
namespace Home\Controller;
use Home\Common\Controller\CommonController;
/**
 * 订单控制器
 * +--------------------------------+
 * |订单状态说明                    |
 * +--------------------------------+
 * |----0 : 无效订单                |
 * |----1 : 订单被提交              |
 * |----2 : 客服已处理（发货）      |
 * |----3 : 订单已完成              |
 * |----4 : 申请退货中              |
 * |----5 : 已退货退款（订单取消）  |
 * |----6 : 有商品正在申请换货中    |
 * +--------------------------------+
 * |配送方式说明                    |
 * |----0 : 无配送（自提）          |
 * |----1 : 普通快递                |
 * |----2 : 顺丰快递                |
 * +--------------------------------+
 */
class OrderController extends CommonController {

    // 未完成订单
    public function index () {
        $where = array(
            'aid'    => $_SESSION['uid'],
            'status' => array(1, 2, 4, 6, 'or')
            );

        $orders = \Common\Util\OrdersProducts::orders($where);

        $this->count = M('order')->where($where)->count();
        $this->orders = $orders;
        $this->display();
    }

    // 订单详情
    public function orderInfo () {
        $oid = I('oid', 0, 'intval');
        $aid = $_SESSION['uid'];
        $order = \Common\Util\OrdersProducts::order($oid, $aid);
        $remarks = M('remark')->where('oid = '.$oid)->order('time DESC')->select();

        $this->order = $order;
        $this->remarks = $remarks;
        $this->display();
    }

    // 已完成订单
    public function orderCompleted () {
        $where = array(
            'aid'    => $_SESSION['uid'],
            'status' => array(0, 3, 5, 'or')
            );

        $orders = \Common\Util\OrdersProducts::orders($where);

        $this->orders = $orders;
        $this->display();
    }

    // 确认订单完成
    public function completeOrder () {
        $oid = I('oid', 0, 'intval');
        $aid = $_SESSION['uid'];
        $where = array(
            'id'  => $oid,
            'aid' => $_SESSION['uid']
            );
        if (M('order')->where($where)->save(array('status' => 3))) {
            // 写一条订单备注
            $remark = array(
                'oid'  => $oid,
                'uid'  => $aid,
                'text' => '代理已确认收货，订单完成',
                'time' =>time()
                );
            M('remark')->add($remark);
            $this->success('订单已完成', U(MODULE_NAME.'/Order/orderInfo', array('oid' => $oid)));
        } else {
            $this->error('确认失败');
        }
    }

    // 退货
    public function returnGoods () {
        $oid = I('oid', 0, 'intval');
        $aid = $_SESSION['uid'];
        $where = array(
            'id'  => $oid,
            'aid' => $aid
            );
        if (M('order')->where($where)->save(array('status' => 4))) {
            // 写一条备注
            $remark = array(
                'oid'  => $oid,
                'uid'  => $aid,
                'text' => '代理已提交退货申请',
                'time' =>time()
                );
            M('remark')->add($remark);
            $this->success('退货申请提交成功', U(MODULE_NAME.'/Order/orderInfo', array('oid' => $oid)));
        } else {
            $this->error('申请提交失败');
        }
    }

    // 单个商品换货
    public function exchange () {
        $oid = I('oid', 0, 'intval');
        $pid = I('pid', 0, 'intval');
        $aid = $_SESSION['uid'];
        $ptitle = I('ptitle');
        // 修改订单状态
        $where = array(
            'id'  => $oid,
            'aid' => $aid
            );
        if (M('order')->where($where)->save(array('status' => 6))) {
            // 修改订单内商品换货信息
            M('order_products')->where(array('oid' => $oid, 'pid' => $pid))->save(array('exchange' => 1));
            // 写一条订单备注
            $remark = array(
                'oid'  => $oid,
                'uid'  => $aid,
                'text' => '代理对商品'.$ptitle.'提交了换货申请',
                'time' => time()
                );
            M('remark')->add($remark);
            $this->success('对商品'.$ptitle.'的换货申请提交成功');
        } else {
            $this->error('换货申请提交失败');
        }
    }

}
?>