<?php 
namespace Home\Controller;
use Home\Common\Controller\CommonController;
/**
 * 购物车及收银台控制器
 */
class CartController extends CommonController {

    public function index () {
        $aid = $_SESSION['uid'];
        $db = M('product');
        $cart = M('cart')->where('aid = '.$aid)->select();
        foreach ($cart as &$v) {
            $v['p_info'] = $db->where('id='.$v['pid'])->find();
        }
        
        $this->count = M('cart')->where('aid = '.$aid)->count();
        $this->cart = $cart;
        $this->display();
    }

    // 添加到购物车，ajax方式处理
    public function addToCart () {
        $db = M('cart');
        $pid = I('pid', 0, 'intval');
        $cart = array(
            'aid' => (int) $_SESSION['uid'],
            'pid' => $pid,
            'num' => 1
            );

        $return = array();

        // 检查购物车中是否已有相同商品
        if ($db->where($cart)->count()) {
            $return['status'] = 0;
        } else {
            $db->add($cart);
            $return['status'] = 1;
        }

        $this->ajaxReturn($return, 'json');
    }

    // 清空购物车
    public function clearCart () {
        $aid = (int) $_SESSION['uid'];
        M('cart')->where('aid = '.$aid)->delete();

        $this->success("购物车已清空");
    }

    // Ajax方式返回订单价格
    public function calPrice () {
        $data = array(
            'area' => I('area', 0, 'intval'),
            'type' => I('type', 0, 'intval')
        );

        $products_info = $_POST['info'];

        $rule = M('express')->where($data)->find();
        if (empty($rule)) {
            $return = array(
                'status' => 0
                );
            $this->ajaxReturn($return, 'json');
        } else {
            // 生成cart数组
            foreach ($products_info as $key => $v) {
                $cart['num'][$v[0]] = $v[1];
            }

            // 查询所有商品
            $products = self::products($cart);
            // 计算商品总价及配送重量
            $temp = self::products_price($cart, $products);
            $price = $temp['price'];
            $weight = $temp['weight'];
            // 查询代理规则（折扣）
            $discount = self::agent_discount();
            // 折后价格
            $discount_price = $price * $discount;            
            // 配送费用
            $express_price = self::express_price($weight, $rule);
            $tot_price = $discount_price + $express_price;

            $return = array(
                'status'    => 1,
                'price'     => $price,
                'discount'  => $discount_price,
                'express'   => $express_price,
                'tot_price' => $tot_price
                );

            $this->ajaxReturn($return, 'json');
        }
    }

    /**
     * 收银台
     * +------------------------------------------------+
     * +------------------变量说明----------------------+
     * |                                                |
     * |  $cart           : 购物车信息                  |
     * |  $products       : 所有购买商品的信息          |
     * |  $agent          : 代理信息                    |
     * |  $price          : 商品总价（不包括配送费用）  |
     * |  $discount_price : 折后价格（不包括配送费用）  |
     * |  $tot_price      : 总价                        |
     * |  $rule           : 代理规则                    |
     * |  $express        : 配送规则                    |
     * |  $account        : 待写入account表的数据       |
     * |                                                |
     * +------------------------------------------------+
     * +-----------------工作流程-----------------------+
     */
    public function cashier () {
        $cart = $_POST;

        // 查询所有选购商品信息
        $products = self::products($cart);

        // 查询代理等级信息
        $agent = M('agent')->where('id='.$_SESSION['uid'])->find();
        $level = $agent['level'];
        // 查询代理规则
        $rule = M('agent_rule')->where('level='.$level)->field(array('discount'))->find();
        $discount = $rule['discount'];

        // ------生成账单数据------
        $discount_price = 0.0;
        $tot_price      = 0.0;
        $weight         = 0.0;
        $express_price  = 0.0;

        // 计算总价、折后价及配送重量
        $data = self::products_price($cart, $products);
        $price = $data['price'];
        $weight = $data['weight'];
        $discount_price = $price * $discount;

        // 查询匹配的配送规则
        // 若配送方式为自提（$cart['express'] = 0）则这步跳过
        if ($cart['express']) {
            $area = explode(',', $cart['area']);
            $express = M('express')->where(array('type' => $cart['express'], 'area' => $area[0]))->find();
            if (!$express) {
                $this->error('没有相应配送规则，请联系管理员');
            }

            // 计算配送费用
            $express_price = self::express_price($weight, $express);
        }
        // 生成订单总价
        $tot_price = $express_price + $discount_price;
        
        // ------数据库操作------
        // 生成账单表并插入数据库，获得订单ID
        $order = array(
            'order_id'       => time(),
            'time'           => time(),
            'aid'            => (int) $_SESSION['uid'],
            'weight'         => $weight,
            'express'        => $cart['express'],
            'address'        => $cart['address'],
            'price'          => $price,
            'discount_price' => $discount_price,
            'tot_price'      => $tot_price,
            'express_price'  => $express_price,
            'pay_type'       => $cart['pay_type']
            );
        $oid = M('order')->add($order);
        if (!$oid) {
            $this->error('提交订单失败');
        }

        // 生成账单_商品表并插入数据库
        foreach ($products as $key => $v) {
            $order_products[] = array(
                'oid' => $oid,
                'pid' => $v['id'],
                'num' => $cart['num'][$v['id']]
                );
            $o_p_id = M('order_products')->add($order_products[$key]);
            if (!$o_p_id) {
                $this->error('提交订单失败');
            }
        }

        // 商品库存减少
        foreach ($products as $key => $v) {
            M('product')->where('id='.$v['id'])->save(array('remainder' => $v['remainder'] - $cart['num'][$v['id']]));
        }

        // 扣除代理货款并写入account表
        $account = array(
            'aid'          => $agent['id'],
            'time'         => $order['time'],
            'operate'      => 2,
            'amount'       => $tot_price,
            'last_account' => $agent['account'],
            'new_account'  => $agent['account'] - $tot_price,
            'reamrk'       => '消费，订单号'.$order['order_id']
            );
        M('agent')->where('id='.$agent['id'])->save(array('account' => $agent['account'] - $tot_price));
        M('account')->add($account);

        // 清空用户购物车
        $del_cart = M('cart')->where('aid='.$_SESSION['uid'])->delete();
        if (!$del_cart) {
            $this->error('清空购物车出现问题，请及时联系管理员');
        }

        // 写一条订单备注
        $text = '订单'.$order['order_id'].'已成功提交，待客服审核。';
        $remark = array(
            'oid'  => $oid,
            'uid'  => $_SESSION['uid'],
            'text' => $text,
            'time' => time()
            );
        M('remark')->add($remark);

        $this->success('订单提交成功', U(MODULE_NAME.'/Order/index'));
    }

    // 查询购物车内所有商品函数
    private function products ($cart) {
        $item = 0;
        foreach ($cart['num'] as $key => $v) {
            $products[] = M('product')->where('id = '.$key)->find();
            // 检查库存是否充足
            if ($products[$item]['remainder'] - $v < 0) {
                $error = $products[$item]['title'].'的库存不足，请减少购买量';
                $this->error($error);
            }
            $item++;
        }

        return $products;
    }

    // 计算总价及配送重量函数
    private function products_price ($cart, $products) {
        $price = 0.0;
        $weight = 0.0;

        foreach ($products as $v) {
            $price += $v['price'] * $cart['num'][$v['id']];
            $weight += $v['weight'] * $cart['num'][$v['id']];
        }

        $data = array(
            'price'  => $price,
            'weight' => $weight
        );

        return $data;
    }

    // 查询代理规则（折扣）
    private function agent_discount () {
        // 查询代理等级信息
        $agent = M('agent')->where('id='.$_SESSION['uid'])->find();
        $level = $agent['level'];
        // 查询代理规则
        $rule = M('agent_rule')->where('level='.$level)->field(array('discount'))->find();
        $discount = $rule['discount'];

        return $discount;
    }

    // 计算配送费用函数
    private function express_price ($weight, $rule) {
        $express_price = $rule['start_price'];
        if ($weight > $rule['start_weight']) {
            $weight -= $rule['start_weight'];
            while (($weight - $rule['step_weight']) >= (-1 * $rule['step_weight'])) {
                $weight -= $rule['step_weight'];
                $express_price += ($rule['step_weight'] * $rule['step_price']);
            } 
        }

        return $express_price;
    }

}
?>