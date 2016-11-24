<?php
if((isset($_GET['page']) && $_GET['page'] == "mine"))
{
	$projectManager = new ProjectManager($db);
	$list = $projectManager->findAll();
	for($i=0; $i < sizeof($list); $i++)
	{
		$project = $list[$i];
		if(isset($_GET['admin']))
			require('views/project_preview_back.phtml');
		else
			require('views/project_preview.phtml');
	}
}
else
{
	$projectManager = new ProjectManager($db);
	$list = $projectManager->findExample();
	for ($i=0; $i < sizeof($list); $i++)
	{
		$project = $list[$i];
		require('views/project_preview_home.phtml');
	}
}
?>