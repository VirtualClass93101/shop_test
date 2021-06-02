<?php 
    include("def.php");
    $sql = "select * from {$tableName} where {$bef}Status = 1";
    $result = mysqli_query($dblink,$sql);
?>  
<!DOCTYPE html>
<html lang="en">
<head>
    <title><?=$webSite?></title>
    <meta charset="UTF-8">
    <script src="<?=$path?>js/jquery.min.js"></script>
    <script src="<?=$path?>js/jquery.session.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            //按下加入購物車 會跳出購物籃頁面
            $(".pop").click(function() {
            	//清空購物籃頁面
                $(".cart").empty();
                var itemSno = $(this).siblings("input").attr("name");
                var itemName = $(this).siblings("input").val();
                var itemSrc = $(this).siblings("img").attr("src");
                //產生購物籃頁面
                $(".cart").append("<h2>"+itemName+"</h2><img class='cart-img' src='"+itemSrc+"' /><input type='hidden' name='itemSno' value="+itemSno+"><input type='number' name='itemNum' value='0'><div class='cart-button'><button class='button add'><?=$addToCart?></button><button class='button cancel'><?=$cancel?></button></div>");
                $(".cart").slideToggle("slow");
            })
            //購物籃頁面 按下取消 
            $('.cart').on('click', '.cancel', function() {
                $(".cart").slideToggle("slow");
                $(".cart").empty();
            });
            //購物籃頁面 按下加入購物車 將資訊放到cookie
            $('.cart').on('click', '.add', function() {
                $.ajax({
                    type: "POST", 
                    url: "store.php",
                    dataType: "text",
                    data: {
                        itemSno:$("input[name=itemSno]").val(),
                        itemValue:$("input[name=itemNum]").val()
                    },
                    success: function(data) {
                        //TODO
                    },
                    error: function(jqXHR) {
                        //TODO 
                    }
                })
                //清空購物籃頁面
                $(".cart").slideToggle("slow");
                $(".cart").empty();
            });

            $('.side-col').click(function() {
                var sno = $(this).attr("name").split('_');
                if(sno[1]==0){
                    $(".grid").css("display","block");
                }else{
                    $(".grid").css("display","none");
                    $(".sno_"+sno[1]).css("display","block");
                }
                    
            });
        });

    </script>
</head>
<body>
<?php include("{$path}header.php")?>
<div class="cart">
</div>
<div class="row">
    <div class="side">
        <!-- 商品類別 -->
        <h3><?=$commodityTypeTile?></h3>
        <?php foreach($commodityType as $commoditySno => $commodityName){?>
        <div class="side-col hover" name="sno_<?=$commoditySno?>"><a><?=$commodityName?></a></div><br>
        <?php }?>
    </div>
    <div class="main">
        <!-- 列出商品 -->
        <?php while($row = mysqli_fetch_assoc($result)){?>
        <div class="grid sno_<?=$row[$bef."Sno"]?>">
            <h2><?=$row[$bef."Name"]?></h2>
            <img class="img" src="<?=$row[$bef."Img"]?>"/><br> 
                <h5><?=$priceTag.":".$row[$bef."Price"]." ".$shippingFee.":".$row[$bef."ShippingFee"]?></h5>               
                <input type="hidden" name="<?=$row[$bef."Sno"]?>" value="<?=$row[$bef."Name"]?>">               
                <button class="button pop"><?=$addToCart?></button>           
        </div>
        <?php }?>
    </div>
</div>
<div class="footer"></div>
</body>
</html>
