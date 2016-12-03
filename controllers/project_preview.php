<?php
if(isset($_GET['page']))
{
	if($_GET['page'] == "mine")
	{
		$projectManager = new ProjectManager($db);
		$list = $projectManager->findAll();
		for($i=0; $i < sizeof($list); $i++)
		{
			$project = $list[$i];
			require('views/project_preview.phtml');
		}
	}
	elseif($_GET['page'] == "projects" && isset($_GET['admin']))
	{
		$projectManager = new ProjectManager($db);
		$list = $projectManager->findAll();
		for($i=0; $i < sizeof($list); $i++)
		{
			$project = $list[$i];
			require('views/project_preview_back.phtml');
		}
	}
	elseif($_GET['page'] == "home")
	{
		$projectManager = new ProjectManager($db);
		$list = $projectManager->findExample();
		for ($i=0; $i < sizeof($list); $i++)
		{
			$project = $list[$i];
			require('views/project_preview.phtml');
		}
	}
}
else
{
	$projectManager = new ProjectManager($db);
	$list = $projectManager->findExample();
	for ($i=0; $i < sizeof($list); $i++)
	{
		$project = $list[$i];
		require('views/project_preview.phtml');
	}
}
?>