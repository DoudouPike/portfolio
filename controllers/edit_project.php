<?php
if(isset($_GET['id']))
	$projectManager = new ProjectManager($db);
	$project = $projectManager->findById($_GET['id']);	
	require("views/edit_project.phtml");
?>