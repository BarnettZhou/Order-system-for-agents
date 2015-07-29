<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>查看所有用户</title>
</head>
<body>
    <h1>网站管理员</h1>
    <table>
        <tr>
            <th>用户ID</th>
            <th>用户名</th>
            <th>昵称</th>
            <th>角色</th>
            <th>操作</th>
        </tr>
        <?php if(is_array($users)): foreach($users as $key=>$v): ?><tr>
                <td><?php echo ($v["id"]); ?></td>
                <td><?php echo ($v["username"]); ?></td>
                <td><?php echo ($v["nickname"]); ?></td>
                <td><?php echo ($v["rolename"]); ?></td>
                <td>
                    [<a href="<?php echo U(MODULE_NAME.'/User/alterUser', array('uid' => $v['id'], 'name' => $v['username']));?>">更改用户信息</a>]
                    [<a href="<?php echo U(MODULE_NAME.'/User/changePwd', array('uid' => $v['id'], 'name' => $v['username']));?>">更改密码</a>]
                </td>
            </tr><?php endforeach; endif; ?>
    </table>

    <hr>

    <h1>代理</h1>
    <table>
        <tr>
            <th>用户ID</th>
            <th>用户名</th>
            <th>昵称</th>
            <th>微信号</th>
            <th>代理等级</th>
            <th>代理权限截止时间</th>
            <th>账户资金</th>
            <th>操作</th>
        </tr>
        <?php if(is_array($agents)): foreach($agents as $key=>$v): ?><tr>
                <td><?php echo ($v["id"]); ?></td>
                <td><?php echo ($v["username"]); ?></td>
                <td><?php echo ($v["nickname"]); ?></td>
                <td><?php echo ($v["wechat_id"]); ?></td>
                <td><?php echo ($v["level"]); ?></td>
                <td><?php echo (date("Y年m月d日", $v["auth_time"])); ?></td>
                <td><?php echo ($v["account"]); ?></td>
                <td>
                    [<a href="<?php echo U(MODULE_NAME.'/User/changeAccount', array('aid' => $v['id'], 'name' => $v['username']));?>">更改账户资金</a>]
                    [<a href="<?php echo U(MODULE_NAME.'/User/alterUser', array('uid' => $v['id'], 'name' => $v['username']));?>">更改用户信息</a>]
                    [<a href="<?php echo U(MODULE_NAME.'/User/changePwd', array('uid' => $v['id'], 'name' => $v['username']));?>">更改密码</a>]
                </td>
            </tr><?php endforeach; endif; ?>
    </table>
</body>
</html>