<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>订单首页</title>
</head>
<body>
    <p>
    [<a href="<?php echo U(MODULE_NAME.'/Index');?>">回到首页</a>]
    [<a href="<?php echo U(MODULE_NAME.'/Order/index');?>">订单管理</a>]
    [<a href="<?php echo U(MODULE_NAME.'/Cart/index');?>">购物车</a>]
</p>
    <h1>订单首页</h1>
    <?php if($count > 0): ?><h2>所有未完成订单</h2>
        <?php if(is_array($orders)): foreach($orders as $key=>$v): ?><table>
                <tr>
                    <th>订单号</th>
                    <th>时间</th>
                    <th>配送重量</th>
                    <th>配送方式</th>
                    <th>订单总价</th>
                    <th>付款方式</th>
                    <th>订单状态</th>
                    <th>操作</th>
                </tr>
                <tr>
                    <td><?php echo ($v["order_id"]); ?></td>
                    <td>
                        <?php echo (date("Y年m月d日", $v["time"])); ?><br>
                        <?php echo (date("H:i:s", $v["time"])); ?>
                    </td>
                    <td><?php echo ($v["weight"]); ?>&nbsp;kg</td>
                    <td><?php echo ($v["express"]); ?></td>
                    <td><?php echo ($v["tot_price"]); ?></td>
                    <td><?php echo ($v["pay_type"]); ?></td>
                    <td><?php echo ($v["status"]); ?></td>
                    <td>
                        <?php if($v['status_code'] == 2): ?>[<a href="<?php echo U(MODULE_NAME.'/Order/completeOrder', array('oid' => $v['id']));?>">确认订单</a>]
                            <br>
                            [<a href="<?php echo U(MODULE_NAME.'/Order/returnGoods', array('oid' => $v['id']));?>">退货申请</a>]<?php endif; ?>
                        <?php if($v['status_code'] == 1): ?>[<a href="">取消订单</a>]<?php endif; ?>
                    </td>
                </tr>
                <tr>
                    <td colspan="8">
                        <a href="<?php echo U(MODULE_NAME.'/Order/orderInfo', array('oid' => $v['id']));?>"><?php echo ($v["title"]); ?>等<?php echo ($v["count"]); ?>个商品</a>
                    </td>
                </tr>
            </table>
            <br><?php endforeach; endif; ?>
    <?php else: ?>
        <h2>无未完成订单</h2><?php endif; ?>
</body>
</html>