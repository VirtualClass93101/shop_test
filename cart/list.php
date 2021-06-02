<?php
	include('./def.php');
	$cartItem = array();
	$shippingFee = 0;
	$amount = 0;
	$alert = array() ;
	//購物車內容
	foreach ($_COOKIE as $itemSno => $itemNum) {
		if(is_numeric($itemSno)&&intval($itemNum)>0){
			$cartItem[$itemSno] = $itemNum;
			$amount +=$commodityItemPrice[$itemSno]*$itemNum;
			$shippingFee = $shippingFee<$commodityItemShip[$itemSno]?$commodityItemShip[$itemSno]:$shippingFee;
			//若有存貨量不足的訊息
			if(isset($_COOKIE["err_".$itemSno]))$alert[] = $_COOKIE["err_".$itemSno];
		}


	}
	$amount+=$shippingFee;
	$afterDiscount = $amount;
?>
<!DOCTYPE html>
<html>
<head>
	<title><?=$webSite?></title>
	<script src="<?=$path?>js/jquery.min.js"></script>
	<script src="<?=$path?>js/jquery.cookie.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {

        	<?php if(!empty($alert))echo "alert('".implode(',\n',$alert)."')"?>

        	//檢查coupon
           	$("input[name=coupon]").blur(function() {
           		//coupon 欄位為空不檢查
           		if($(this).val()!=""){
					$.ajax({
	                    type: "POST", 
	                    url: "check_coupon.php",
	                    dataType: "text",
	                    data: $('.form').serialize(),
	                    success: function(data) {
	                    	//coupon通過所有條件
	                    	if((data!="<?=$notEnough?>")&&(data!="<?=$unqualified?>")&&(data!="<?=$invalidCoupon?>")){
	                    		//替換金額計算
		                    	var tmp = data.split(",");
		                    	$(".afterDiscount").val(tmp[2]);
		                    	$(".summary").empty();
		                    	$(".summary").html('<?=$amountTitle?>:<s style="color:red">'+tmp[0]+'</s> '+tmp[2]+'<?=$currency?>&nbsp;(<?=$shippinFeeTitle?>:'+tmp[1]+'<?=$currency?>)');
	                    	}else{
	                    		alert(data);
	                    		$("input[name=coupon]").val("");
	                    	}
	                    },
	                    error: function(jqXHR) {
	                    	//TODO
	                    }
	                });
	            }
           	})


            $(".del").click(function() {
            	var delSno = $(this).siblings(".itemSno").val();
            	//刪除該品項 且刪除Error Msg
            	$.cookie(delSno, null, { expires: -1, path: '/' });
            	$.cookie("err_"+delSno, null, { expires: -1, path: '/' });
            	location.reload();
            })
            $(".itemNum").change(function() {
            	var updateSno = $(this).siblings(".itemSno").val();
            	var updateNum = $(this).val();
            	$.cookie(updateSno, updateNum, { expires: 60*60*24, path: '/' });
            	$.cookie("err_"+updateSno, null, { expires: -1, path: '/' });
            	location.reload();
            })
            $(".submit").click(function() {
            	$(".act").val("add");
            })

  
        });
    </script>
</head>
<body>
<?php include("{$path}header.php")?>
<form name="listform" class="form" action="" method="post">
	<input type="hidden"  name="act" class="act" value="">
	<input type="hidden" name="amount" class="amount" value="<?=$amount?>">
	<input type="hidden" name="afterDiscount" class="afterDiscount" value="<?=$afterDiscount?>">
	<input type="hidden" name="shippingFee" value="<?=$shippingFee?>">
	<div class="list">
			<!-- <div class="list"> -->
				<!-- 列出購物車清單 -->
		        <?php foreach($cartItem as $itemSno => $itemNum){?>
		        <div class="list-grid">
		        	<div class="grid-left">
		        		<?=$commodityItem[$itemSno]?>  
		        		<?=$priceTitle?>: <?=$commodityItemPrice[$itemSno]?><?=$currency?>
		        	</div>
		        	<div class="grid-right">
		        		<input type="number" name="itemNum[]"  class="itemNum"   value="<?=$itemNum?>">
		        		<button class="button del"><?=$delBtn?></button>
		        		<input type="hidden" name="itemSno[]"   class="itemSno"   value="<?=$itemSno?>">
			        	<input type="hidden" name="itemName[]"  class="itemName"  value="<?=$commodityItem[$itemSno]?>">
			        	<input type="hidden" name="itemPrice[]" class="itemPrice" value="<?=$commodityItemPrice[$itemSno]?>">
		        	</div>
		        	
		        	
		       	</div>
		        <?php }?>
		        <br>
		        <div class="list-grid">
			        <div class="summary grid-left" style="float: left;">
				        <?=$amountTitle?>:<?=$amount?><?=$currency?>&nbsp;
				        (<?=$shippinFeeTitle?>:<?=$shippingFee?><?=$currency?>)
			        </div>
			        <div class="grid-right">
				        <input type="text" name="coupon"  placeholder="<?=$couponPlaceholder?>">
				        <button type="submit" class="button submit" ><?=$submitBtn?></button> 
			        </div>
		    </div>
		        
		   <!--  </div> -->
	</div>
</form>
<div style="clear: both"></div>
<?php include("{$path}footer.php")?>
</body>
</html>