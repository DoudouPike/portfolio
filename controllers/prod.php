<?php
if(isset($_GET['id']))
{
	$prodManager = new ProdManager($db);
	$prod = $prodManager->findById($_GET['id']);

	if(!$prod)
	{
		$error = "Cette réalisation n'existe pas.";
		require('controllers/error.php');
	}
	else
		require('views/prod.phtml');
		
}
else
{
	$empty = "Cliquez sur la réalisation de votre choix";
	require('views/empty.phtml');
}
?>