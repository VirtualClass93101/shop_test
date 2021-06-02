<?php
	include("./def.php");
	
	$sql = "select * from {$tableName3} where {$bef3}Code='{$_POST['coupon']}'";
	$result = mysqli_query($dblink,$sql); 
   	$row = mysqli_fetch_assoc($result);

   	if($row!=NULL){
   		//如果總金額小於折扣最低消費
   		if($_POST['amount']<$row["{$bef3}Limit"]){
			echo $notEnough;
	   	}else{
	   		//查看購物籃是否包含優惠券品項
		   	$isInCart = 1;
		   	$itemSnoList = explode(",",$row["{$bef3}Item"]);
		   	foreach ($itemSnoList as $key => $value) {
		   		if(!in_array($value,$_POST['itemSno'])){
		   			$isInCart=0;
		   			break;
		   		}
		   	}
		   	//不符合使用優惠券資格
		   	if($isInCart==0){
		   		echo $unqualified;
		   	}else{
		   		//回傳總金額,運費,折扣後金額
	   			$afterDiscount = (intval($_POST['amount'])-intval($row[$bef3."Discount"]));
	   			echo "{$_POST['amount']},{$_POST['shippingFee']},{$afterDiscount}";
		   		
		   	}
		}
	}else{
		//無此優惠券
		echo $invalidCoupon;
	}

?>