<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>设置配送规则</title>
</head>
<body>
    <h1>新增配送规则</h1>
    <form action="<?php echo U(MODULE_NAME.'/Agent/expressHandle');?>" method="post">
        <table>
            <tr>
                <td>规则标题</td>
                <td>
                    <input type="text" name="title" />
                </td>
            </tr>
            <tr>
                <td>快递类型</td>
                <td>
                    <input type="radio" name="type" value="1" />普通快递
                    <br>
                    <input type="radio" name="type" value="2" />顺丰快递
                </td>
            </tr>
            <tr>
                <td>选择区域</td>
                <td>
                    <select name='area' name2="areaname">
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
                </td>
            </tr>
            <tr>
                <td>起始重量（kg）</td>
                <td>
                    <input type="text" name="start_weight" />
                </td>
            </tr>
            <tr>
                <td>起始运费（元）</td>
                <td>
                    <input type="text" name="start_price" />
                </td>
            </tr>
            <tr>
                <td>单位重量（kg）</td>
                <td>
                    <input type="text" name="step_weight" />
                </td>
            </tr>
            <tr>
                <td>单位运费（元）</td>
                <td>
                    <input type="text" name="step_price" />
                </td>
            </tr>
            <tr>
                <td colspan="2" align="center">
                    <input type="submit" value="确认添加" />
                </td>
            </tr>
        </table>
    </form>
</body>
</html>