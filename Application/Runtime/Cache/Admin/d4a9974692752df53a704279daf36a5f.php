<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>修改商品信息|<?php echo ($product["title"]); ?></title>
</head>
<body>
    <h1>修改一个商品|<?php echo ($product["title"]); ?></h1>
    <form action="<?php echo U(MODULE_NAME.'/Product/alterProductHandle');?>" enctype="multipart/form-data" method="post">
        <dl>
            <dt>商品名称</dt>
            <dd>
                <input type="text" name="title" value="<?php echo ($product["title"]); ?>"/>
            </dd>
            <dt>商品描述</dt>
            <dd>
                <textarea name="remark"><?php echo ($product["remark"]); ?></textarea>
            </dd>
            <dt>商品图片</dt>
            <dd>
                <input type="file" name="image" />
            </dd>
            <dt>商品单价</dt>
            <dd>
                <input type="text" name="price" value="<?php echo ($product["price"]); ?>"/>
            </dd>
            <dt>配送重量</dt>
            <dd>
                <input type="text" name="weight" value="<?php echo ($product["weight"]); ?>" />
            </dd>
            <dt>商品分类</dt>
            <dd>
                <select name="cid">
                    <option value="0">---选择商品分类---</option>
                    <?php if(is_array($cate)): foreach($cate as $key=>$v): if($v['id'] == $product['cid']): ?><option value="<?php echo ($v["id"]); ?>" selected><?php echo ($v["title"]); ?></option>
                        <?php else: ?>
                            <option value="<?php echo ($v["id"]); ?>"><?php echo ($v["title"]); ?></option><?php endif; endforeach; endif; ?>
                </select>
            </dd>
            <dt>
                <input type="hidden" name="id" value="<?php echo ($product["id"]); ?>">
                <input type="submit" value="确认修改" />
            </dt>
        </dl>
    </form>
</body>
</html>