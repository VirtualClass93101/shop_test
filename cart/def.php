<?php
	$path = "../";
	$bef="ol";
	$bef2="ci";
	$bef3="cl";
	$Nsno = $bef."Sno";
	$Nsno2 = $bef2."Sno";
	$Nsno3 = $bef3."Sno";
	$modelId = "order_list";
	$modelId2 = "commodity_item";
	$modelId3 = "coupon_list";
	$tableName = "{$modelId}";
	$tableName2 = "{$modelId2}";
	$tableName3 = "{$modelId3}";

	include("{$path}/language/lang.php");
	include("{$path}/language/cart.php");
	include("{$path}/function/function.php");
	include("{$path}/config/dbconfig.php");
	include("{$path}/tmp/commodity_item.php");


	if($_POST['act'] == "add"){
		
		$inputArr = [];
		$rep = returnpost($_POST);
		$item = [];
		$i=0;
		//檢查存貨量
		foreach ($rep['itemName'] as $itemKey => $itemName) {
			$item[] = "{$itemName} * {$rep['itemNum'][$itemKey]}";
			$sql = "select {$bef2}Input from {$tableName2} where {$Nsno2}=".$rep['itemSno'][$itemKey];
			$result = mysqli_query($dblink,$sql); 
   			$row = mysqli_fetch_assoc($result);
   			//存貨量不足的訊息
   			if($row["{$bef2}Input"]<$rep['itemNum'][$itemKey]){
   				setcookie("err_{$rep['itemSno'][$itemKey]}","存貨不足 {$itemName} 剩餘:".$row["{$bef2}Input"],time()+60*60*24,'/');
   				$i++;
   			}
   			$inputArr[$rep['itemSno'][$itemKey]][0]=$row["{$bef2}Input"];
   			$inputArr[$rep['itemSno'][$itemKey]][1]=$rep['itemNum'][$itemKey];
		}
		//存貨量夠的話 送出這筆訂單 並減去對應存貨量
		if($i==0){
			$sql = "insert into {$tableName} set 
			{$bef}Account = 'No One' ,
			{$bef}CommodityList = '".implode(",",$item)."' ,
			{$bef}Amount = '".$rep['afterDiscount']."' ,
			{$bef}Coupon = '".$rep['coupon']."' ,
			{$bef}EstablishedTime = '".date("Y-m-d")."' ,
			{$bef}UpdateTime = '".date("Y-m-d")."' ,
			{$bef}shippingFee = '".$rep['shippingFee']."' ";
			
			mysqli_query($dblink,$sql);

			foreach ($inputArr as $sno => $val) {
				$sql = "update {$tableName2} set 
				{$bef2}Input = ".($val[0]-$val[1])." 
				where {$Nsno2} = '{$sno}' ";
				mysqli_query($dblink,$sql);
			}
			foreach ($_COOKIE as $key => $value) {
				unset($_COOKIE[$key]); 
	    		setcookie($key, null, -1, '/'); 
			}
			header("{path}index.php");
			
		}else{
			header("list.php");

		}
	}
?>