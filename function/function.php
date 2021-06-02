<?php
//去html < > 和處理衝碼字
function returnpost($post=null , $nohtml=null , $noaddsla=null){
	foreach($post as $key => $val){
		if(!is_array($val) and !in_array($key , $nohtml)){
			$post[$key] = htmlspecialchars($val , ENT_QUOTES);
		}elseif(is_array($val)){
			foreach($val as $key2 => $val2){
				if(!is_array($val2) and !in_array($key2 , $nohtml)){
					$post[$key][$key2] = htmlspecialchars($val2 , ENT_QUOTES);
				}elseif(is_array($val2)){
					foreach($val2 as $key3 => $val3){
						if(!in_array($key3 , $nohtml)){
							$post[$key][$key2][$key3] = htmlspecialchars($val3 , ENT_QUOTES);
						}else{
							//$post[$key][$key2][$key3] = $val3;
						}
					}
				}else{
					//$post[$key][$key2] = $val2;
				}
			}
		}else{
			//$post[$key] = $val;
		}
	}
    if(!get_magic_quotes_gpc()){		//for PHP5.x以下
	//if(1){								//for PHP6.0
		foreach($post as $key => $val){
			if(!is_array($val) and !in_array($key , $noaddsla)){
				$post[$key] = addslashes($val);
			}elseif(is_array($val)){
				foreach($val as $key2 => $val2){
					if(!is_array($val) and !in_array($key , $noaddsla)){
						$post[$key][$key2] = addslashes($val2);
					}elseif(is_array($val2)){
						foreach($val2 as $key3 => $val3){
							if(!in_array($key3 , $noaddsla)){
								$post[$key][$key2][$key3] = addslashes($val3);
							}else{
								//$post[$key][$key2][$key3] = $val3;
							}
						}
					}else{
						//$post[$key][$key2] = $val2;
					}
				}
			}else{
				//$post[$key] = $val;
			}
		}
	}
	return $post;
}

function change_type(){
	global $dblink;
	$sql = " select * from product_type where ptStatus = 1";
	$result = mysqli_query($dblink,$sql); 
    $resultTotal = mysqli_num_rows($result);
    $text = "<?php\n";
	$text .= "\$typeList = array();\n";
	
	for($i=0;$i<$resultTotal;$i++)
	{
		$row = mysqli_fetch_assoc($result);
		$text .= "\$typeList[{$row['ptSno']}]='{$row['ptName']}';\n";
	}
	
	$text .= "?>";
	
	$fp = fopen("../tmp/product_item_tmp.php" , "w");
	$text = stripslashes($text);
	fwrite($fp , $text);
	fclose($fp);

}
?>