<?php
$prodManager = new ProdManager($db);
$list = $prodManager->findAll();

for ($i=0; $i < sizeof($list); $i++)
{
	$prod = $list[$i];
	if(isset($_GET['admin']))
		require('views/prod_preview_back.phtml');
	else
		require('views/prod_preview.phtml');
}
?>