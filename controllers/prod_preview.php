<?php
$prodManager = new ProdManager($db);
$tabs = $prodManager->findAll();

for ($i=0; $i < sizeof($tabs); $i++)
{
	if(isset($_GET['admin']))
		require('views/prod_preview_back.phtml');
	else
		require('views/prod_preview.phtml');
}
?>