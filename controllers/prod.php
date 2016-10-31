<?php
if(isset($_GET['id']))
{
	$prodManager = new ProdManager($db);
	$prod = $prodManager->findById($_GET['id']);
	require('views/prod.phtml');
}
else
{
	$empty = "Cliquez sur la réalisation de votre choix";
	require('views/empty.phtml');
}
?>