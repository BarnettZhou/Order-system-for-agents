<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>更改商品库存|<?php echo ($product["title"]); ?></title>
</head>
<body>
    <h1>更改商品库存</h1>
    <form action="<?php echo U(MODULE_NAME.'/Product/changeRemainderHandle');?>" method="post">
        <dl>
            <dt>商品名称</dt>
            <dd><?php echo ($product["title"]); ?></dd>            
        </dl>
        <dl>
            <dt>现有库存</dt>
            <dd><?php echo ($product["remainder"]); ?></dd>
        </dl>
        <dl>
           <dt>选择操作</dt>
            <dd>
                <input type="radio" name="operate" value="1">增加库存
                <input type="radio" name="operate" value="0">减少库存
            </dd>
            <dd>
                <p>
                    数量<input type="text" name="num" />
                </p>
            </dd>
        </dl>
        <dl>
            <dt>备注</dt>
            <dd>
                <textarea name="remark"></textarea>
            </dd>
        </dl>
        <dl>
            <dd>
                <input type="hidden" name="pid" value="<?php echo ($product["id"]); ?>" />
                <input type="submit" value="确认更改" />
            </dd>
        </dl>
    </form>
</body>
</html>