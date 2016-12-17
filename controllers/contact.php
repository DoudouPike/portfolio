<?php
if(isset($_SESSION['id']))
{
	$userManager = new UserManager($db);
	$user = $userManager->findById($_SESSION['id']);
}
if(isset($_SESSION['successMail']))
{
	require("views/successMail.phtml");
	unset($_SESSION['successMail']);
}
require("views/contact.phtml");
?>