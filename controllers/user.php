<?php
$userManager = new UserManager($db);
$list = $userManager->findAll();

for($i=0; $i < sizeof($list); $i++)
{
	$user = $list[$i];
	require('views/user.phtml');
}
?>