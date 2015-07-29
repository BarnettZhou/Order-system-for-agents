<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>代理规则设置</title>
</head>
<body>
    <h1>代理规则设置</h1>
    <form action="<?php echo U(MODULE_NAME.'/Agent/agentRuleHandle');?>" method="post">
        <table>
            <tr>
                <td>规则名</td>
                <td>
                    <input type="text" name="rulename" />
                </td>
            </tr>
            <tr>
                <td>针对等级</td>
                <td>
                    <input type="text" name="level" />
                </td>
            </tr>
            <tr>
                <td>折扣</td>
                <td>
                    <input type="text" name="discount" />折
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <input type="submit" value="确认添加" />
                </td>
            </tr>
        </table>
    </form>
</body>
</html>