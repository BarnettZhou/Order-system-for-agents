$(function () {

    $(".addToCart").click(function () {
        var id = $(this).children(".pid").val();
        var remainder = $(this).children(".remainder").val();

        if (remainder == 0) {
            alert("商品库存不足！");
        } else {
            $.ajax({
                url : addURL,
                async : false,
                type : "POST",
                data : {pid : id},
                dataType : "json",
                timeout : 1000,
                error : function () {alert("error");},
                success : function (data) {
                    if (data.status == 0) {
                        alert("购物车中已有相同商品");
                    } else {
                        alert("添加成功");
                    }
                }
            });
        }
    });

});