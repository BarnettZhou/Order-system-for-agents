<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>添加订单备注</title>
</head>
<body>
    <h1>添加订单备注</h1>
    <form action="<?php echo U(MODULE_NAME.'/Order/addRemarkHandle');?>" method="post">
        <table>
            <tr>
                <td>备注内容</td>
                <td>
                    <textarea name="text"></textarea>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <input type="hidden" name="oid" value="<?php echo ($oid); ?>" />
                    <input type="submit" value="添加备注" />
                </td>
            </tr>
        </table>
    </form>
</body>
</html>