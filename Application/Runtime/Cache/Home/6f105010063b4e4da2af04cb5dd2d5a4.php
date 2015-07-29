<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>购物车</title>
    <!-- <script type="text/javascript" src="/agentapp/Application/Home/Common/Public/Js/jQuery/2.1.4/jquery.js"></script> -->
    <script type="text/javascript" src="/agentapp/Application/Home/Common/Public/Js/jQuery/1.7.2/jQuery.min.js"></script>
    <script type="text/javascript" src="/agentapp/Application/Home/Common/Public/Js/cart.js"></script>
    <script type="text/javascript">
        var calURL = "<?php echo U(MODULE_NAME.'/Cart/calPrice');?>";
    </script>
</head>
<body>
    <p>
    [<a href="<?php echo U(MODULE_NAME.'/Index');?>">回到首页</a>]
    [<a href="<?php echo U(MODULE_NAME.'/Order/index');?>">订单管理</a>]
    [<a href="<?php echo U(MODULE_NAME.'/Cart/index');?>">购物车</a>]
</p>
    <h1>购物车</h1>
    <?php if($count > 0): ?><form action="<?php echo U(MODULE_NAME.'/Cart/cashier');?>" method="post">
            <table>
                <tr>
                    <th>商品名</th>
                    <th>单价</th>
                    <th>配送重量（kg）</th>
                    <th>数量</th>
                </tr>
                <?php if(is_array($cart)): foreach($cart as $key=>$v): ?><tr align="right">
                        <td><?php echo ($v["p_info"]["title"]); ?></td>
                        <td><?php echo ($v["p_info"]["price"]); ?></td>
                        <td><?php echo ($v["p_info"]["weight"]); ?></td>
                        <td>
                            <span class="p_info">
                                <input type="hidden" class="pid" value="<?php echo ($v["pid"]); ?>">
                                <input type="text" name="num[<?php echo ($v["pid"]); ?>]" class="num" value="<?php echo ($v["num"]); ?>" />
                            </span>
                        </td>
                    </tr><?php endforeach; endif; ?>
                <tr>
                    <td>选择快递方式</td>
                    <td>
                        <select name="express" id="express">
                            <option value="1">普通快递</option>
                            <option value="2">顺丰快递</option>
                            <option value="0">自提</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>选择配送省份</td>
                    <td>
                        <select name='area' id="area">
    <option value="00">---请选择地区---</option>
    <option value="11,北京市">北京市</option>
    <option value="12,天津市">天津市</option>
    <option value="13,河北省">河北省</option>
    <option value="14,山西省">山西省</option>
    <option value="15,内蒙古自治区">内蒙古自治区</option>
    <option value="21,辽宁省">辽宁省</option>
    <option value="22,吉林省">吉林省</option>
    <option value="23,黑龙江省">黑龙江省</option>
    <option value="31,上海市">上海市</option>
    <option value="32,江苏省">江苏省</option>
    <option value="33,浙江省">浙江省</option>
    <option value="34,安徽省">安徽省</option>
    <option value="35,福建省">福建省</option>
    <option value="36,江西省">江西省</option>
    <option value="37,山东省">山东省</option>
    <option value="41,河南省">河南省</option>
    <option value="42,湖北省">湖北省</option>
    <option value="43,湖南省">湖南省</option>
    <option value="44,广东省">广东省</option>
    <option value="45,广西壮族自治区">广西壮族自治区</option>
    <option value="46,海南省">海南省</option>
    <option value="50,重庆市">重庆市</option>
    <option value="51,四川省">四川省</option>
    <option value="52,贵州省">贵州省</option>
    <option value="53,云南省">云南省</option>
    <option value="54,西藏自治区">西藏自治区</option>
    <option value="61,陕西省">陕西省</option>
    <option value="62,甘肃省">甘肃省</option>
    <option value="63,青海省">青海省</option>
    <option value="64,宁夏回族自治区">宁夏回族自治区</option>
    <option value="65,新疆维吾尔自治区">新疆维吾尔自治区</option>
    <option value="66,新疆兵团外经贸局">新疆兵团外经贸局</option>
</select>
                        &nbsp;<a href="#" id="calPrice">计算总费用</a>
                    </td>
                </tr>
                <tr>
                    <td>填写详细地址</td>
                    <td>
                        <input type="text" name="address" />
                    </td>
                </tr>
                <tr>
                    <td>选择支付方式</td>
                    <td>
                        <select name="pay_type">
                            <option value="1">使用账户余额支付</option>
                            <option value="0">自行打款</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td colspan="2"><div id="price"></div></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" value="确认订单">
                        &nbsp;<a href="<?php echo U(MODULE_NAME.'/Cart/clearCart');?>">清空购物车</a>
                    </td>
                </tr>
            </table>
        </form>
    <?php else: ?>
        <h2>购物车为空</h2><?php endif; ?>
</body>
</html>