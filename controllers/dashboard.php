<?php
if(isset($_SESSION['id']))
{
	$manager = new UserManager($db);
	$user = $manager->findById($_SESSION['id']);
	if($user->getAdmin() === "1")
		require('views/dashboard_admin.phtml');
	else
		require('views/dashboard.phtml');
}
?>