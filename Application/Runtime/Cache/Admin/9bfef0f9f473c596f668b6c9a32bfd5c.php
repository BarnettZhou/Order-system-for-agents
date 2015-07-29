<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>查看商品分类</title>
</head>
<body>
    <h1>查看所有商品分类</h1>
    <ul>
        <?php if(is_array($cate)): foreach($cate as $key=>$v): ?><li>编号：<?php echo ($v["id"]); ?>
                <ul>
                    <li>名称：<?php echo ($v["title"]); ?></li>
                    <li>排序：<?php echo ($v["sort"]); ?></li>
                    [<a href="<?php echo U(MODULE_NAME.'/Category/alterCate', array('id' => $v['id'], 'title' => $v['title'], 'sort' => $v['sort']));?>">修改</a>]
                    [<a href="<?php echo U(MODULE_NAME.'/Category/deleteCate', array('id' => $v['id']));?>">删除</a>]
                </ul>
            </li><br /><?php endforeach; endif; ?>
    </ul>
</body>
</html>