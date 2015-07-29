<?php 
namespace Admin\Controller;
use Admin\Common\Controller\CommonController;
class OrderController extends CommonController {

    // 待审核、待退货及待换货订单
    public function index () {
        $where = array('status' => array(1, 4, 6, 'or'));
        $orders = \Common\Util\OrdersProducts::orders($where);

        $this->orders = $orders;
        $this->display();
    }

    // 正在处理的订单
    public function orderInHand () {
        $where = array('status' => '2');
        $orders = \Common\Util\OrdersProducts::orders($where);

        $this->orders = $orders;
        $this->display();
    }

    // 所有过往订单
    public function orderCompleted () {
        $where = array('status' => array(0, 3, 5, 'or'));
        $count = M('order')->where($where)->count();

        // 分页设置
        $page = new \Think\Page($count, 1);
        $show = $page->show();

        $orders = \Common\Util\OrdersProducts::orders($where, $page);
        $this->orders = $orders;
        $this->page = $show;
        $this->display();
    }

    // 订单详情
    public function orderInfo () {
        $oid = I('oid', 0, 'intval');
        $order = \Common\Util\OrdersProducts::order($oid);
        $remarks = M('remark')->where('oid = '.$oid)->order('time DESC')->select();

        $this->remarks = $remarks;
        $this->order = $order;
        $this->display();
    }

    // 添加配送信息
    public function addExpress () {
        $oid = (int) $_GET['oid'];
        $this->oid = $oid;
        $this->display();
    }

    // 添加配送信息表单处理
    public function addExpressHandle () {
        $oid = I('oid', 0, 'intval');
        $text  = '订单已发货<br>';
        $text .= '快递公司：'.$_POST['express_company'].'<br>';
        $text .= '快递单号：'.$_POST['express_id'];
        $remark = array(
            'oid'  => $oid,
            'uid'  => $_SESSION['uid'],
            'text' => $text,
            'time' => time()
            );

        p($remark);
        // 写入订单备注表
        if (M('remark')->add($remark)) {
            // 修改订单状态
            M('order')->where('id = '.$oid)->save(array('status' => 2));
            $this->success('配送信息添加成功', U(MODULE_NAME.'/Order/orderInfo', array('oid' => $oid)));
        } else {
            $this->error('配送信息添加失败');
        }
    }

    // 添加订单备注
    public function addRemark () {
        $this->oid = I('oid', 0, 'intval');
        $this->display();
    }

    // 添加订单备注表单处理
    public function addRemarkHandle () {
        $oid = I('oid', 0, 'intval');
        $remark = array(
            'oid'  => $oid,
            'text' => I('text'),
            'uid'  => (int) $_SESSION['uid'],
            'time' => time()
            );

        if (M('remark')->add($remark)) {
            $this->success('订单备注添加成功', U(MODULE_NAME.'/Order/orderInfo', array('oid' => $oid)));
        } else {
            $this->error('订单备注添加失败');
        }
    }

    // 处理退货申请
    public function returnGoods () {
        $this->oid = I('oid', 0, 'intval');
        $this->display();
    }

    // 处理退货申请表单处理
    public function returnHandle () {
        $oid = I('oid', 0, 'intval');
        $operate = I('operate', 0, 'intval');
        $text = I('remark');
        if ($operate) {
            // 修改订单状态
            M('order')->where('id = '.$oid)->save(array('status' => 5));

            $order = M('order')->where('id = '.$oid)->field(array('aid', 'discount_price'))->find();
            $agent = M('agent')->where('id = '.$order['aid'])->field(array('id', 'account'))->find();

            // 返还货款并写入account表及agent表
            $account = array(
                'aid'          => $agent['id'],
                'mid'          => $_SESSION['uid'],
                'time'         => time(),
                'operate'      => 3,
                'amount'       => $order['discount_price'],
                'last_account' => $agent['account'],
                'new_account'  => $agent['account'] + $order['discount_price'],
                'remark'       => '订单退款'
                );
            M('account')->add($account);
            M('agent')->where($agent['id'])->save(array('account' => $account['new_account']));

            // 添加订单备注
            $remark = array(
                'oid'  => $oid,
                'uid'  => $_SESSION['uid'],
                'text' => '退款'.$account['amount'].'至代理账户'.'<br>说明:'.$text,
                'time' => time()
                );
            M('remark')->add($remark);
        } else {
            // 修改订单状态
            M('order')->where('id = '.$oid)->save(array('status' => 2));

            // 添加订单备注
            $remark = array(
                'oid'  => $oid,
                'uid'  => $_SESSION['uid'],
                'text' => '退货申请未通过，请联系客服人员<br>说明:'.$text,
                'time' => time()
                );
            M('remark')->add($remark);
        }

        $this->success('退货申请已处理', U(MODULE_NAME.'/Order/Index'));
    }

    // 处理换货申请
    public function exchange () {
        $this->oid = I('oid', 0, 'intval');
        $this->pid = I('pid', 0, 'intval');
        $this->ptitle = I('ptitle');

        $this->display();
    }

    // 换货表单处理
    public function exchangeHandle () {
        $oid = I('oid', 0, 'intval');
        $pid = I('pid', 0, 'intval');
        $operate = I('operate', 0, 'intval');
        $text = I('remark');

        $remark = array(
                'oid'  => $oid,
                'uid'  => $_SESSION['uid'],
                'time' => time()
        );

        if ($operate) {
            // 修改订单_商品表（order_products）内商品换货信息
            M('order_products')->where(array('oid' => $oid, 'pid' => $pid))->save(array('exchange' => 2));

            // 添加订单备注
            $remark['text'] = '客服已通过换货申请<br>说明:'.$text;
            M('remark')->add($remark);
        } else {
            // 修改订单_商品表（order_products）内商品换货信息
            M('order_products')->where(array('oid' => $oid, 'pid' => $pid))->save(array('exchange' => 3));

            // 添加订单备注
            $remark['text'] = '客服已拒绝换货申请<br>说明:'.$text;
            M('remark')->add($remark);
        }

        $this->success('已处理换货申请', U(MODULE_NAME.'/Order/orderInfo', array('oid' => $oid)));
    }

}
?>