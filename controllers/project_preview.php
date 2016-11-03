<?php
$projectManager = new ProjectManager($db);
$list = $projectManager->findAll();

for ($i=0; $i < sizeof($list); $i++)
{
	$project = $list[$i];
	if(isset($_GET['admin']))
		require('views/project_preview_back.phtml');
	else
		require('views/project_preview.phtml');
}
?>