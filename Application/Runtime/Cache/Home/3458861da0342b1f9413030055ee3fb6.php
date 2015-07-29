<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>查看所有商品分类</title>
    <script type="text/javascript" src="/agentapp/Application/Home/Common/Public/Js/jQuery/1.7.2/jQuery.min.js"></script>
    <script type="text/javascript" src="/agentapp/Application/Home/Common/Public/Js/addToCart.js"></script>
    <script type="text/javascript">
        var addURL = "<?php echo U(MODULE_NAME.'/Cart/addToCart');?>";
    </script>
</head>
<body>
    <p>
    [<a href="<?php echo U(MODULE_NAME.'/Index');?>">回到首页</a>]
    [<a href="<?php echo U(MODULE_NAME.'/Order/index');?>">订单管理</a>]
    [<a href="<?php echo U(MODULE_NAME.'/Cart/index');?>">购物车</a>]
</p>
    <h1>所有分类</h1>
    <ul>
        <?php if(is_array($cate)): foreach($cate as $key=>$v): ?><li><?php echo ($v["title"]); ?>
                <ul>
                    <li>
                        <a href="<?php echo U(MODULE_NAME.'/Product/showByCate', array('cid' => $v['id'], 'cateTitle' => $v['title']));?>">查看商品</a>
                    </li>
                </ul>
            </li>
            <br><?php endforeach; endif; ?>
    </ul>
    <h1>最新上架</h1>
    <ul>
        <?php if(is_array($products)): foreach($products as $key=>$v): ?><li><a href=""><?php echo ($v["title"]); ?></a>
                <ul>
                    <li><img src="http://localhost/agentapp/<?php echo ($v["image"]); ?>" width="60px"></li>
                    <li>价格：<?php echo ($v["price"]); ?>（元）</li>
                    <li>库存：<?php echo ($v["remainder"]); ?></li>
                    <li>配送重量（kg）：<?php echo ($v["weight"]); ?></li>
                    <li>上架时间：<?php echo (date("Y年m月d日", $v["time"])); ?></li>
                    <li>备注：<?php echo ($v["remark"]); ?></li>
                    <li>
                        <!-- [<a href="<?php echo U(MODULE_NAME.'/Cart/addToCart', array('pid' => $v['id']));?>">加入购物车</a>] -->
                        [<a href="" class="addToCart">
                            添加至购物车
                            <input type="hidden" class="pid" value="<?php echo ($v["id"]); ?>">
                            <input type="hidden" class="remainder" value="<?php echo ($v["remainder"]); ?>">
                        </a>]
                    </li>
                </ul>
            </li>
            <br><?php endforeach; endif; ?>
    </ul>
</body>
</html>