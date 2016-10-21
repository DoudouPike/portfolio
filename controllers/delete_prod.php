<?php
if(isset($_GET['id']))
{
	$prodManager = new ProdManager($db);
	$prod = $prodManager->findById($_GET['id']);
	require("views/delete_prod.phtml");
}
?>