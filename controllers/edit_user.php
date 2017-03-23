<?php
if(isset($_GET['id']))
	$userManager = new UserManager($db);
	$user = $userManager->findById($_GET['id']);

	$notAdmin = "";
	$admin = "";
	$notActive = "";
	$active = "";

	if($user->getAdmin() == "0")
		$notAdmin = "checked";
	elseif($user->getAdmin() == "1")
		$admin = "checked";

	if($user->getActive() == "0")
		$notActive = "checked";
	elseif($user->getActive() == "1")
		$active = "checked";
	
	require("views/edit_user.phtml");
?>