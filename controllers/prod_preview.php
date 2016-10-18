<?php
$prodManager = new ProdManager($db);
$prods = $prodManager->findAll();

for ($i=0; $i < sizeof($prods); $i++)
{
	require('views/prod_preview.phtml');
}
?>