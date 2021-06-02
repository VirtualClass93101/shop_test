<?php
    $sno = intval($_POST['itemSno']);
    $val = intval($_POST['itemValue']);

    if($val>0){
    	if(isset($_COOKIE[$sno])){
	    	$oldVal = intval($_COOKIE[$sno]);
	    	$val = $val+$oldVal;
	    	setcookie($sno,strval($val),time()+60*60*24,'/');
	    }else{
	    	setcookie($sno,strval($val),time()+60*60*24,'/');
	    }
    }
        
?>