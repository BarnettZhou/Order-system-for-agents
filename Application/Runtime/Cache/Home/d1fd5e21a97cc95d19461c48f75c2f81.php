<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>已完成订单</title>
</head>
<body>
    <p>
    [<a href="<?php echo U(MODULE_NAME.'/Index');?>">回到首页</a>]
    [<a href="<?php echo U(MODULE_NAME.'/Order/index');?>">订单管理</a>]
    [<a href="<?php echo U(MODULE_NAME.'/Cart/index');?>">购物车</a>]
</p>
    <h1>已完成订单</h1>
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
                    [<a href="">申请售后</a>]
                </td>
            </tr>
            <tr>
                <td colspan="8">
                    <a href="<?php echo U(MODULE_NAME.'/Order/orderInfo', array('oid' => $v['id']));?>"><?php echo ($v["title"]); ?>等<?php echo ($v["count"]); ?>个商品</a>
                </td>
            </tr>
        </table>
        <br><?php endforeach; endif; ?>
</body>
</html>