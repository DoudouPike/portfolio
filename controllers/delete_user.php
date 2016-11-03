<?php
if(isset($_GET['id']))
{
	$userManager = new UserManager($db);
	$user = $userManager->findById($_GET['id']);
	require('views/delete_user.phtml');
}
?>