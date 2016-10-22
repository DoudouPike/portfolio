<?php
if(isset($_GET['id']))
{
	$projectManager = new ProjectManager($db);
	$project = $projectManager->findById($_GET['id']);

	if($project)
	{
		$reviewManager = new ReviewManager($db);
		$list = $reviewManager->findByProject($project);
		if($list)
		{
			for ($i=0; $i < sizeof($list) ; $i++)
			{ 
				$review = $list[$i];
				require("views/review.phtml");
			}
		}
		else
		{
			$empty = "Aucune nouveauté sur ce projet.";
			require("views/empty.phtml");
		}
	}
	else
	{
		$error = "Ce projet n'existe pas.";
		require("controllers/error.php");
	}

}
?>