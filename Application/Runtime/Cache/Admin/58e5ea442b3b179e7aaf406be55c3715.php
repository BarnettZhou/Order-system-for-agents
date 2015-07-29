<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>添加商品分类</title>
</head>
<body>
    <h1>添加一个商品分类</h1>
    <form action="<?php echo U(MODULE_NAME.'/Category/addCateHandle');?>" method="post">
        <table>
            <tr>
                <td align="right">分类名称：</td>
                <td>
                    <input type="text" name="title" />
                </td>
            </tr>
            <tr>
                <td align="right">排序：</td>
                <td>
                    <input type="text" name="sort" />
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <input type="hidden" name="pid" value="<?php echo ($pid); ?>">
                    <input type="submit" value="确认添加" />
                </td>
            </tr>
        </table>
    </form>
</body>
</html>