<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>所有商品</title>
</head>
<body>
    <h1>查看所有商品</h1>
    <table>
        <tr align="right">
            <th>商品ID</th>
            <th>商品名</th>
            <th>价格</th>
            <th>剩余库存</th>
            <th>配送重量</th>
            <th>上架时间</th>
            <th>所属分类ID</th>
            <th>操作</th>
        </tr>
        <?php if(is_array($products)): foreach($products as $key=>$v): ?><tr align="right">
                <td><?php echo ($v["id"]); ?></td>
                <td><?php echo ($v["title"]); ?></td>
                <td><?php echo ($v["price"]); ?>&nbsp;元</td>
                <td><?php echo ($v["remainder"]); ?></td>
                <td><?php echo ($v["weight"]); ?>&nbsp;kg</td>
                <td><?php echo (date("Y-m-d H:i:s", $v["time"])); ?></td>
                <td><?php echo ($v["cid"]); ?></td>
                <td>
                    [<a href="<?php echo U(MODULE_NAME.'/Product/alterProduct', array('id'=>$v['id']));?>">修改商品信息</a>]
                    [<a href="<?php echo U(MODULE_NAME.'/Product/changeRemainder', array('id'=>$v['id']));?>">更改库存</a>]
                    [<a href="">更改价格</a>]
                </td>
            </tr><?php endforeach; endif; ?>
    </table>
    <h3><?php echo ($page); ?></h3>
</body>
</html>