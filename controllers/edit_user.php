<?php
if(isset($_GET['id']))
	$userManager = new UserManager($db);
	$user = $userManager->findById($_GET['id']);

	$notAdmin = "";
	$admin = "";

	if($user->getAdmin() == "0")
		$notAdmin = "checked";
	elseif($user->getAdmin() == "1")
		$admin = "checked";
	
	require("views/edit_user.phtml");
?>