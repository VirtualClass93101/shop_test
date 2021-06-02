<?php
	include('./def.php');
	$sql = "select * from {$tableName}";
    $result = mysqli_query($dblink,$sql); 
    $resultTotal = mysqli_num_rows($result);
    $rowTotal = mysqli_num_rows($result);

?>
<!DOCTYPE html>
<html>
<head>
	<title><?=$webSite?></title>
	<script src="<?=$path?>js/jquery.min.js"></script>
	<script src="<?=$path?>js/jquery.cookie.js"></script>
</head>
<body>
<?php include("{$path}header.php")?>
<form name="listform" class="form" action="" method="post">
	<input type="hidden"  name="act" class="act" value="">
	<input type="hidden" name="amount" class="amount" value="<?=$amount?>">
	<input type="hidden" name="shippingFee" value="<?=$shippingFee?>">
	<div class="list">
		<!-- 列出訂購清單 -->
        <?php while($row = mysqli_fetch_assoc($result)){?>
        <div class="list-grid">
        	<div class="grid-left">
        		<?=$account?>:<?=$row[$bef."Account"]?>, <?=$items?>:<?=$row[$bef."CommodityList"]?>, <?=$coupon?>:<?php echo $row[$bef."Coupon"]==""?"無":$row[$bef."Coupon"]?>, <?=$amount?>:<?=$row[$bef."Amount"]?>(<?=$shippingFee?>:<?=$row[$bef."ShippingFee"]?>)
        	</div>
       	</div>
        <?php }?>
	</div>
</form>
<?php include("{$path}footer.php")?>
</body>
</html>