<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>订单详情</title>
</head>
<body>
    <p>
    [<a href="<?php echo U(MODULE_NAME.'/Index/index');?>">回到后台首页</a>]
</p>
    <h1>订单详情</h1>
    <dl>
        <dt>订单基本信息</dt>
        <dd>
            <table>
                <tr>
                    <th>订单号</th>
                    <th>订单时间</th>
                    <th>订单价格</th>
                    <th>折后价格</th>
                    <th>订单状态</th>
                </tr>
                <tr>
                    <td><?php echo ($order["order_id"]); ?></td>
                    <td>
                        <?php echo (date("Y-m-d", $order["time"])); ?><br>
                        <?php echo (date("H:i:s", $order["time"])); ?>
                    </td>
                    <td><?php echo ($order["price"]); ?></td>
                    <td><?php echo ($order["discount_price"]); ?></td>
                    <td><?php echo ($order["status"]); ?></td>
                </tr>
            </table>
        </dd>
    </dl>
    <dl>
        <dt>配送信息</dt>
        <dd>
            <table>
                <tr>
                    <th>配送重量</th>
                    <th>配送方式</th>
                    <th>配送地址</th>
                    <th>运费总计</th>
                </tr>
                <tr>
                    <td><?php echo ($order["weight"]); ?></td>
                    <td><?php echo ($order["express"]); ?></td>
                    <td><?php echo ($order["address"]); ?></td>
                    <td><?php echo ($order["express_price"]); ?></td>
                </tr>
            </table>
        </dd>
    </dl>
    <dl>
        <dt>支付信息</dt>
        <dd>
            <table>
                <tr>
                    <th>订单总价</th>
                    <th>支付方式</th>
                </tr>
                <tr>
                    <td><?php echo ($order["tot_price"]); ?></td>
                    <td><?php echo ($order["pay_type"]); ?></td>
                </tr>
            </table>
        </dd>
    </dl>
    <dl>
        <dt>购买商品详情</dt>
        <dd>
            <table>
                <tr>
                    <th>图片</th>
                    <th>商品名</th>
                    <th>数量</th>
                    <th>操作</th>
                </tr>
                <?php if(is_array($order["products"])): foreach($order["products"] as $key=>$v): ?><tr>
                        <td></td>
                        <td><?php echo ($v["title"]); ?></td>
                        <td><?php echo ($v["num"]); ?></td>
                        <td>
                            <?php if($v["exchange"] == 1): ?>[<a href="<?php echo U(MODULE_NAME.'/Order/exchange', array('pid' => $v['id'], 'oid' => $order['id'], 'ptitle' => $v['title']));?>">处理换货申请</a>]<?php endif; ?>
                        </td>
                    </tr><?php endforeach; endif; ?>
            </table>
        </dd>
    </dl>
    <p>
        <?php if($order['status_code'] == 1): ?>[<a href="<?php echo U(MODULE_NAME.'/Order/addExpress', array('oid' => $order['id']));?>">添加配送信息</a>]&nbsp;<?php endif; ?>
        <?php if($order['status_code'] == 2): ?>[<a href="<?php echo U(MODULE_NAME.'/Order/returnGoods', array('oid' => $order['id']));?>">处理退货申请</a>]&nbsp;<?php endif; ?>
        [<a href="<?php echo U(MODULE_NAME.'/Order/addRemark', array('oid' => $order['id']));?>">添加备注</a>]
    </p>
    <h2>订单备注</h2>
    <ul>
        <?php if(is_array($remarks)): foreach($remarks as $key=>$v): ?><li>
                <ul>
                    <li>时间：<?php echo (date("m-d H:i:s", $v["time"])); ?></li>
                    <li>内容：<?php echo ($v["text"]); ?></li>
                    <li>用户：<?php echo ($v["uid"]); ?></li>
                </ul>
            </li><?php endforeach; endif; ?>
    </ul>
</body>
</html>