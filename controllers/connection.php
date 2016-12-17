<?php
if(isset($_SESSION['successBeforeReg']))
{
	require('views/successBeforeReg.phtml');
	unset($_SESSION['successBeforeReg']);
}
if(isset($_SESSION['successNewPwd']))
{
	require('views/successNewPwd.phtml');
	session_destroy();
}
if(isset($_GET['log'], $_GET['id'], $_SESSION['uniqid']))
{
	$userManager = new UserManager($db);
	try
	{
		$user = $userManager->findByLogin(urldecode($_GET['log']));
		if(!$user)
			throw new Exception("Ce pseudo n'existe pas");
		if($_SESSION['uniqid'] != $_GET['id'])
			throw new Exception("Cet ID n'est pas compatible");	
		$user->setActive("1");
		$active = $userManager->updateActive($user);
		if(!$active)
			throw new Exception("Erreur interne. Contactez moi");
		require('views/successRegister.phtml');
	}
	catch(Exception $e)
	{
		$error = $e->getMessage();
	}
}
	
require('views/connection.phtml');
?>