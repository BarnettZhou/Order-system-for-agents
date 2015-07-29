<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>所有正在处理的订单</title>
</head>
<body>
    <h1>所有正在处理的订单</h1>
    <?php if(is_array($orders)): foreach($orders as $key=>$v): ?><dl>
            <dt>订单号[<?php echo ($v["order_id"]); ?>]</dt>
            <dd>
                <table>
                    <tr>
                        <th>时间</th>
                        <th>代理ID</th>
                        <th>订单状态</th>
                    </tr>
                    <tr>
                        <td>
                            <?php echo (date("H-m-d H:i:s", $v["time"])); ?>
                        </td>
                        <td><?php echo ($v["aid"]); ?></td>
                        <td><?php echo ($v["status"]); ?></td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <p><?php echo ($v["title"]); ?>等<?php echo ($v["count"]); ?>个商品</p>
                        </td>
                    </tr>
                    <tr>
                        <td>操作</td>
                        <td>
                            [<a href="<?php echo U(MODULE_NAME.'/Order/orderInfo', array('oid' => $v['id']));?>">订单详情</a>]
                            [<a href="<?php echo U(MODULE_NAME.'/Order/addRemark', array('oid' => $v['id']));?>">添加备注</a>]
                        </td>
                    </tr>
                </table>
            </dd>
        </dl><?php endforeach; endif; ?>
</body>
</html>