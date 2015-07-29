<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>后台管理</title>
</head>
<body>
    <h1>管理页面</h1>
    <ul>
        <li>用户名：<?php echo ($userinfo["username"]); ?></li>
        <li>用户角色：<?php echo ($userinfo["rolename"]); ?></li>
        <li>昵称：<?php echo ($userinfo["nickname"]); ?></li>
    </ul>
    <h2>选择接下来的操作</h2>
    <ul>
        <li>商品分类
            <ul>
                <li><a href="<?php echo U(MODULE_NAME.'/Category/index');?>">查看商品分类</a></li>
                <li><a href="<?php echo U(MODULE_NAME.'/Category/addCate');?>">添加商品分类</a></li>
            </ul>
        </li>
        <br />
        <li>商品
            <ul>
                <li><a href="<?php echo U(MODULE_NAME.'/Product/index');?>">查看所有商品</a></li>
                <li><a href="<?php echo U(MODULE_NAME.'/Product/addProduct');?>">添加商品</a></li>
            </ul>
        </li>
        <br />
        <li>用户
            <ul>
                <li><a href="<?php echo U(MODULE_NAME.'/User/index');?>">查看用户</a></li>
                <li><a href="<?php echo U(MODULE_NAME.'/User/addUser');?>">添加用户</a></li>
            </ul>
        </li>
        <li>订单处理
            <ul>
                <li><a href="<?php echo U(MODULE_NAME.'/Order/index');?>">查看所有待处理订单</a></li>
                <li><a href="<?php echo U(MODULE_NAME.'/Order/orderInHand');?>">查看所有正在配送订单</a></li>
                <li><a href="<?php echo U(MODULE_NAME.'/Order/orderCompleted');?>">查看过往订单</a></li>
            </ul>
        </li>
        <br>
        <li>代理相关
            <?php if($_SESSION['role'] == 0): ?><ul>
                    <li><a href="<?php echo U(MODULE_NAME.'/Agent/index');?>">代理规则</a></li>
                    <li><a href="<?php echo U(MODULE_NAME.'/Agent/agentRule');?>">代理规则设置</a></li>
                    <li><a href="<?php echo U(MODULE_NAME.'/Agent/express');?>">配送规则设置</a></li>
                </ul>
            <?php else: ?>
                <ul>
                    <li>你所在的用户组没什么卵用</li>
                </ul><?php endif; ?>
        </li>
    </ul>
    <a href="<?php echo U(MODULE_NAME.'/Index/logout');?>">退出登陆</a>
</body>
</html>