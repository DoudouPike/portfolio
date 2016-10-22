<?php
if(isset($_GET['page']))
{
	if($_GET['page'] == "dashboard")
	{
		$commentManager = new CommentManager($db);
		$list = $commentManager->findByUser($user);
		if($list)
		{
			for ($i=0; $i < sizeof($list) ; $i++)
			{ 
				$comment = $list[$i];
				require("views/comment.phtml");
			}
		}
		else
		{
			$empty = "Vous n'avez posté aucun commentaire.";
			require("views/empty.phtml");
		}
	}
	elseif(isset($_GET['id']) && $_GET['page'] == "comments")
	{
		$projectManager = new ProjectManager($db);
		$project = $projectManager->findById($_GET['id']);

		if($project)
		{
			$commentManager = new CommentManager($db);
			$list = $commentManager->findByProject($project);
			if($list)
			{
				for ($i=0; $i < sizeof($list) ; $i++)
				{ 
					$comment = $list[$i];
					require("views/comments.phtml");
				}
			}
			else
			{
				$empty = "Aucun commentaire pour ce projet";
				require("views/empty.phtml");
			}
		}
		else
		{
			$error = "Ce projet n'existe pas.";
			require("controllers/error.php");
		}
	}
	elseif(isset($_GET['id']) && $_GET['page'] == "mine")
	{
		var_dump("A FAIRE !");
	}
}
?>