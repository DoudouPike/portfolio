<?php
if(isset($_GET['page']))
{
	if($_GET['page'] == "portfolio")
	{
		$prodManager = new ProdManager($db);
		$list = $prodManager->findAll();
		for($i=0; $i < sizeof($list); $i++)
		{
			$prod = $list[$i];
			require('views/prod_preview.phtml');
		}
	}
	else
	{
		$prodManager = new ProdManager($db);
		$list = $prodManager->findExample();
		for($i=0; $i < sizeof($list); $i++)
		{
			$prod = $list[$i];
			require('views/prod_preview.phtml');
		}
	}
}
else
{
	$prodManager = new ProdManager($db);
	$list = $prodManager->findExample();
	for($i=0; $i < sizeof($list); $i++)
	{
		$prod = $list[$i];
		require('views/prod_preview.phtml');
	}
}
?>