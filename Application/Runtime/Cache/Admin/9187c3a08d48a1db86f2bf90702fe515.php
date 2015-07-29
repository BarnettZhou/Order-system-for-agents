<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>修改商品分类</title>
</head>
<body>
    <h1>修改商品分类</h1>
    <form action="<?php echo U(MODULE_NAME.'/Category/alterCateHandle');?>" method="post">
        <table>
            <tr>
                <td align="right">分类名称：</td>
                <td>
                    <input type="text" name="title" value="<?php echo ($cate["title"]); ?>"/>
                </td>
            </tr>
            <tr>
                <td align="right">排序：</td>
                <td>
                    <input type="text" name="sort" value="<?php echo ($cate["sort"]); ?>"/>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <input type="hidden" name="id" value="<?php echo ($cate["id"]); ?>" />
                    <input type="submit" value="确认修改" />
                </td>
            </tr>
        </table>
    </form>
</body>
</html>