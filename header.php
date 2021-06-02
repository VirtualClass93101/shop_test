<link rel="stylesheet" type="text/css" href="<?=$path?>css/main.css">
<div class="header">
	<a href="<?=$path?>index.php"><h1><?=$webSiteTitle?></h1></a>
	<p><?=$webSiteSubTitle?></p>
</div>

<div class="navbar">
	<?php foreach($webPage as $webPageTitle => $webPageUrl){?>
  	<a href="<?=$path.$webPageUrl?>"><?=$webPageTitle?></a>
  	<?php }?>
  	<a href="<?=$path?>manage/index.php" class="right"><?=$backStage?></a>
</div>