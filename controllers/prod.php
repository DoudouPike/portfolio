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
	$element = "la réalisation";
	require('views/select.phtml');
}
?>