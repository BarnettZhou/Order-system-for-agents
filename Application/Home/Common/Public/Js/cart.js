$(function() {

    $("#calPrice").click( function () {
        var area = $("#area").val().split(',');
        var express = $("#express").val();
        var area_code = area[0];

        if (express != "0") {
            if(area_code == "00") {
                alert("请选择配送地区！");
            } else {
                var p_info = new Array();
                var i = 0, j = 0;

                /*
                    格式：
                    array(
                        [0] : [pid, num],
                        [1] : [pid, num]
                        ......
                    )
                */
                $(".p_info").each(function () {
                    p_info[i] = new Array();
                    $(this).children().each(function () {
                        p_info[i][j] = $(this).val();
                        j++;
                    });
                    i++;
                    j = 0;
                });

                $.post(calURL, {
                        area : area_code,
                        type : express,
                        info : p_info
                    }, function (data) {
                        if (data["status"] == 0) {
                            alert('暂无匹配的配送方法');
                        } else {
                            var str  = "<h4>订单总价：" + data["tot_price"] + "￥</h4>";
                                str += "<p>商品价格：" + data["price"] + "￥</p>";
                                str += "<p>折后价格：" + data["discount"] + "￥</p>";
                                str += "<p>配送费用：" + data["express"] + "￥</p>"
                            $("#price").html(str);
                        }
                    }, 'json'
                );
            }
        }

    });
    
});