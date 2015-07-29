<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>添加商品</title>
</head>
<body>
    <h1>添加一个商品</h1>
    <form action="<?php echo U(MODULE_NAME.'/Product/addProductHandle');?>" enctype="multipart/form-data" method="post">
        <dl>
            <dt>商品名称</dt>
            <dd>
                <input type="text" name="title" />
            </dd>
            <dt>商品描述</dt>
            <dd>
                <textarea name="remark"></textarea>
            </dd>
            <dt>商品图片</dt>
            <dd>
                <input type="file" name="image" />
            </dd>
            <dt>商品单价</dt>
            <dd>
                <input type="text" name="price" />
            </dd>
            <dt>初始库存</dt>
            <dd>
                <input type="text" name="remainder" />
            </dd>
            <dt>商品分类</dt>
            <dd>
                <select name="cid">
                    <option value="0">---选择商品分类---</option>
                    <?php if(is_array($cate)): foreach($cate as $key=>$v): ?><option value="<?php echo ($v["id"]); ?>"><?php echo ($v["title"]); ?></option><?php endforeach; endif; ?>
                </select>
            </dd>
            <dt>
                <input type="hidden" name="time" value="<?php echo time();?>" />
                <input type="submit" value="确认添加" />
            </dt>
        </dl>
    </form>
</body>
</html>