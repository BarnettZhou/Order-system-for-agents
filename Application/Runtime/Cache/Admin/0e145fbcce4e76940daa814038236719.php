<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>更改账户信息|<?php echo ($user["name"]); ?></title>
</head>
<body>
    <h1>更改账户信息&nbsp;|&nbsp;<?php echo ($user["name"]); ?></h1>
    <form action="<?php echo U(MODULE_NAME.'/User/changeAccountHandle');?>" method="post">
        <table>
            <tr>
                <td>账户原有资金</td>
                <td><?php echo ($user["last_account"]); ?></td>
            </tr>
            <tr>
                <td>输入资金</td>
                <td>
                    <input type="text" name="amount" />
                </td>
            </tr>
            <tr>
                <td>选择操作</td>
                <td>
                    <input type="radio" name="operate" value="1" />增加资金
                    <br />
                    <input type="radio" name="operate" value="0" />减少资金
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <input type="hidden" name="aid" value="<?php echo ($user["aid"]); ?>" />
                    <input type="hidden" name="last_account" value="<?php echo ($user["last_account"]); ?>" />
                    <input type="submit" value="确认修改" />
                </td>
            </tr>
        </table>
    </form>
</body>
</html>