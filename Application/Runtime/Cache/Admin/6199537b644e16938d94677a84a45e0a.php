<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>添加配送信息</title>
</head>
<body>
    <h1>添加配送信息</h1>
    <form action="<?php echo U(MODULE_NAME.'/Order/addExpressHandle');?>" method="post">
        <table>
            <tr>
                <td>快递公司</td>
                <td>
                    <input type="text" name="express_company" />
                </td>
            </tr>
            <tr>
                <td>运单号</td>
                <td>
                    <input type="text" name="express_id" />
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <input type="hidden" name="oid" value="<?php echo ($oid); ?>">
                    <input type="submit" value="确认添加" />
                </td>
            </tr>
        </table>
    </form>
</body>
</html>