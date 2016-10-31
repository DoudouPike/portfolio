<?php
if(isset($_GET['id']))
{
	$projectManager = new projectManager($db);
	$project = $projectManager->findById($_GET['id']);

	if(!$project)
	{
		$error = "Ce projet n'existe pas.";
		require('controllers/error.php');
	}
	else		
		require('views/project.phtml');
}
else
{
	$empty = "Choisissez un projet.";
	require('views/empty.phtml');
}
?>