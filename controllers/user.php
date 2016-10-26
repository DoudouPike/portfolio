<?php
$userManager = new UserManager($db);
$tabs = $userManager->findAll();

for($i=0; $i < sizeof($tabs); $i++)
{ 
	require('views/user.phtml');
}
?>