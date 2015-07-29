<?php 
namespace Common\Util;
class OrdersProducts {

    // 查询所有订单详情函数
    // ----------------------
    // $where为传入的查询条件
    // $page为传入的分页对象
    // ----------------------
    static public function orders ($where, $page = null) {
        // 订单基本信息
        // $orders = M('order')->where($where)->field(array('id'))->select();
        if (!empty($page)) {
            $orders = M('order')->where($where)->limit($page->firstRow.','.$page->listRows)->field(array('id'))->select();
        } else {
            $orders = M('order')->where($where)->field(array('id'))->select();
        }

        foreach ($orders as $k => &$v) {
            // 订单内所含商品总数
            $count = M('order_products')->where('oid = '.$v['id'])->count();

            // 订单详细信息及订单内商品信息
            $v = self::order($v['id']);

            $v['count'] = $count;
            $v['title'] = $v['products'][0]['title'];
        }

        return $orders;
    }

    /**
     * 查询单张订单详情
     * @param int $oid  订单编号
     * @param int $aid  代理编号，若请求从后台页面发出则无需检查
     *
     * @return array $order  订单详细信息
     * 
     */
    static public function order ($oid, $aid = null) {
        $where = !$aid ? array('id' => $oid) : array('id' => $oid, 'aid' => $aid);
        $order = M('order')->where($where)->find();
        $order_products = M('order_products')->where('oid='.$oid)->select();
        foreach ($order_products as $key => $v) {
            $order['products'][$key] = M('product')->where('id='.$v['pid'])->find();
            $order['products'][$key]['num'] = $order_products[$key]['num'];
            $order['products'][$key]['exchange'] = $order_products[$key]['exchange'];
            $order['products'][$key]['exchangeInfo'] = self::isExchange($order_products[$key]['exchange']);
        }

        $order['status_code'] = $order['status'];
        $order['status'] = self::orderStatus($order['status']);
        $order['express'] = self::expressInfo($order['express']);
        $order['pay_type'] = self::payType($order['pay_type']);

        return $order;
    }

    /**
     * 几个判断函数，均为private
     * 建议采用JavaScript在前端页面完成
     * 目前暂时在后台完成业务逻辑
     */

    // 判断订单状态函数
    private function orderStatus ($status) {
        switch ($status) {
            case 0:
                $orderStatus = '无效订单';
                break;
            case 1:
                $orderStatus = '订单待审核';
                break;
            case 2:
                $orderStatus = '客服已处理';
                break;
            case 3:
                $orderStatus = '订单已完成';
                break;
            case 4:
                $orderStatus = '退货申请中';
                break;
            case 5:
                $orderStatus = '已退货';
                break;
            case 6:
                $orderStatus = '订单内有换货申请';
                break;
            default:
                $orderStatus = '订单状态未知';
                break;
        }

        return $orderStatus;
    }

    // 判断订单内商品是否处于换货状态函数
    private function isExchange ($exchange) {
        switch($exchange) {
            case 0:
                $exchangeInfo = '无换货状态';
                break;
            case 1:
                $exchangeInfo = '该商品正在进行换货';
                break;
            case 2:
                $exchangeInfo = '该商品换货已完成';
                break;
            case 3:
                $exchangeInfo = '客服已拒绝换货申请';
                break;
            default:
                $exchangeInfo = '换货状态未知';
                break;
        }

        return $exchangeInfo;
    }

    // 判断配送方式函数
    private function expressInfo ($express) {
        switch ($express) {
            case 0:
                $expressInfo = '自提';
                break;
            case 1:
                $expressInfo = '普通快递';
                break;
            case 2:
                $expressInfo = '顺丰快递';
                break;
            default:
                $expressInfo = '配送方式未知';
                break;
        }

        return $expressInfo;
    }

    // 判断付款方式函数
    private function payType ($type) {
        switch ($type) {
            case 0:
                $payType = '自主打款';
                break;
            case 1:
                $payType = '账户资金付款';
                break;
            default:
                $payType = '付款方式未知';
                break;
        }

        return $payType;
    }

}
?>