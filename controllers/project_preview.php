<?php
$projectManager = new ProjectManager($db);
$tabs = $projectManager->findAll();

for ($i=0; $i < sizeof($tabs); $i++)
{
	if(isset($_GET['admin']))
		require('views/project_preview_back.phtml');
	else
		require('views/project_preview.phtml');
}
?>