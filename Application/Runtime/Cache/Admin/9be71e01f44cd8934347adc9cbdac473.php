<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>修改用户密码|<?php echo ($user["name"]); ?></title>
</head>
<body>
    <h1>修改用户密码|<?php echo ($user["name"]); ?></h1>
    <form action="<?php echo U(MODULE_NAME.'/User/changePwdHandle');?>" method="post">
        <table>
            <tr>
                <td>原密码</td>
                <td>
                    <input type="password" name="old_pwd" />
                </td>
            </tr>
            <tr>
                <td>新密码</td>
                <td>
                    <input type="password" name="new_pwd" />
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <input type="hidden" name="id" value="<?php echo ($user["uid"]); ?>" />
                    <input type="submit" value="确认修改" />
                </td>
            </tr>
        </table>
    </form>
</body>
</html>