<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo ($cate); ?>|查看商品</title>
</head>
<body>
    <p>
    [<a href="<?php echo U(MODULE_NAME.'/Index');?>">回到首页</a>]
    [<a href="<?php echo U(MODULE_NAME.'/Order/index');?>">订单管理</a>]
    [<a href="<?php echo U(MODULE_NAME.'/Cart/index');?>">购物车</a>]
</p>
    <h1><?php echo ($cate); ?>下所有商品</h1>
    <table>
        <tr align="right">
            <th>商品ID</th>
            <th>商品名</th>
            <th>价格</th>
            <th>剩余库存</th>
            <th>配送重量</th>
            <th>上架时间</th>
            <th>操作</th>
        </tr>
        <?php if(is_array($products)): foreach($products as $key=>$v): ?><tr align="right">
                <td><?php echo ($v["id"]); ?></td>
                <td><?php echo ($v["title"]); ?></td>
                <td><?php echo ($v["price"]); ?></td>
                <td><?php echo ($v["remainder"]); ?></td>
                <td><?php echo ($v["weight"]); ?></td>
                <td><?php echo (date("Y-m-d H:i:s", $v["time"])); ?></td>
                <td>
                    [<a href="<?php echo U(MODULE_NAME.'/Cart/addToCart', array('pid' => $v['id']));?>">加入购物车</a>]
                </td>
            </tr><?php endforeach; endif; ?>
    </table>
    <h3><?php echo ($page); ?></h3>
</body>
</html>