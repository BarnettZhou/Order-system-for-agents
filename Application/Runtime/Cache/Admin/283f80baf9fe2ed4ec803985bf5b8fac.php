<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>代理规则</title>
</head>
<body>
    <h1>代理规则</h1>
    <table>
        <tr>
            <th>ID</th>
            <th>规则名</th>
            <th>针对等级</th>
            <th>折扣</th>
            <th>操作</th>
        </tr>
        <?php if(is_array($agentRule)): foreach($agentRule as $key=>$v): ?><tr>
                <td><?php echo ($v["id"]); ?></td>
                <td><?php echo ($v["rulename"]); ?></td>
                <td><?php echo ($v["level"]); ?></td>
                <td><?php echo ($v["discount"]); ?></td>
                <td>
                    [<a href="">修改</a>]
                    [<a href="">删除</a>]
                </td>
            </tr><?php endforeach; endif; ?>
    </table>
    <br>
    <a href="<?php echo U(MODULE_NAME.'/Agent/agentRule');?>">新增一条代理规则</a>
    <h1>配送规则</h1>
    <table>
        <tr>
            <th>ID</th>
            <th>规则名</th>
            <th>快递类型</th>
            <th>适用地区</th>
            <th>起始重量</th>
            <th>起始运费</th>
            <th>单位重量</th>
            <th>单位运费</th>
            <th>操作</th>
        </tr>
        <?php if(is_array($express)): foreach($express as $key=>$v): ?><tr>
                <td><?php echo ($v["id"]); ?></td>
                <td><?php echo ($v["title"]); ?></td>
                <td>
                    <?php if($v["type"] == 1): ?>普通快递
                    <?php else: ?>
                        顺丰快递<?php endif; ?>
                </td>
                <td><?php echo ($v["areaname"]); ?></td>
                <td><?php echo ($v["start_weight"]); ?></td>
                <td><?php echo ($v["start_price"]); ?></td>
                <td><?php echo ($v["step_weight"]); ?></td>
                <td><?php echo ($v["step_price"]); ?></td>
                <td>
                    [<a href="<?php echo U(MODULE_NAME.'/Agent/alterExpress', array('id' => $v['id']));?>">修改</a>]
                    [<a href="<?php echo U(MODULE_NAME.'/Agent/deleteExpress', array('id' => $v['id']));?>">删除</a>]
                </td>
            </tr><?php endforeach; endif; ?>
    </table>
    <br>
    <a href="<?php echo U(MODULE_NAME.'/Agent/express');?>">新增一条配送规则</a>
</body>
</html>