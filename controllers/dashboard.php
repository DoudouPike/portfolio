<?php
if(isset($_SESSION['id']))
{
	$manager = new UserManager($db);
	$user = $manager->findById($_SESSION['id']);

	if(isset($_SESSION['successUpdate']))
	{
		require('views/successUpdate.phtml');
		unset($_SESSION['successUpdate']);
	}
	require('views/dashboard.phtml');
}
?>