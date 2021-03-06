<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>添加用户</title>
</head>
<body>
    <h1>添加用户</h1>
    <form action="<?php echo U(MODULE_NAME.'/User/addUserHandle');?>" method="post">
        <dl>
            <dt>基本信息</dt>
            <dd>
                登录名
                <input type="text" name="username" />
            </dd>
            <dd>
                密码
                <input type="password" name="password" />
            </dd>
            <dd>
                昵称
                <input type="text" name="nickname" />
            </dd>
        </dl>
        <dl>
            <dt>角色设置</dt>
            <dd>
                <input type="radio" name="role" value="0" />超级管理员
            </dd>
            <dd>
                <input type="radio" name="role" value="1" />普通管理员
            </dd>
            <dd>
                <input type="radio" name="role" value="2" id="agent"/>
                代理
            </dd>
        </dl>
        <dl>
            <dt>
                代理设置项
            </dt>
            <dd>
                微信号
                <input type="text" name="wechat_id" />
            </dd>
            <dd>
                代理等级
                <select name="level">
                    <option value="1">一级代理</option>
                    <option value="2">二级代理</option>
                    <option value="3">三级代理</option>
                    <option value="4">四级代理</option>
                </select>
            </dd>
            <dd>
                代理身份失效日期
                <input type="date" name="auth_time" />
            </dd>
            <dd>
                初始账户金额
                <input type="text" name="account" />
            </dd>
        </dl>
        <dl>
            <input type="submit" value="确认添加" />
        </dl>
    </form>
</body>
</html>