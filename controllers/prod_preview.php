<?php
if((isset($_GET['page']) && $_GET['page'] == "home") || !isset($_GET['page']))
{
	$prodManager = new ProdManager($db);
	$list = $prodManager->findExample();
	for($i=0; $i < sizeof($list); $i++)
	{
		$prod = $list[$i];
		require('views/prod_preview_home.phtml');
	}
}
else
{
	$prodManager = new ProdManager($db);
	$list = $prodManager->findAll();
	for($i=0; $i < sizeof($list); $i++)
	{
		$prod = $list[$i];
		if(isset($_GET['admin']))
			require('views/prod_preview_back.phtml');
		else
			require('views/prod_preview.phtml');
	}
}

?>