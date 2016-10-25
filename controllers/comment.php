<?php
if(isset($_GET['page']))
{
	if($_GET['page'] == "dashboard")
	{
		$commentManager = new CommentManager($db);
		$list = $commentManager->findByUser($user);
		if($list)
		{
			$projectManager = new ProjectManager($db);
			for ($j=0; $j < sizeof($list) ; $j++)
			{ 
				$comment = $list[$j];
				$project = $projectManager->findById($comment->getProject()->getId());
				require("views/comment_list.phtml");
			}
		}
		else
		{
			$empty = "Vous n'avez posté aucun commentaire.";
			require("views/empty.phtml");
		}
	}
	elseif($_GET['page'] == "projects")
	{
		$commentManager = new CommentManager($db);
		$list = $commentManager->findByProject($tabs[$i]);
		if($list)
		{
			for ($j=0; $j < sizeof($list) ; $j++)
			{ 
				$comment = $list[$j];
				require("views/comment.phtml");
			}
		}
		else
		{
			$empty = "Aucun commentaire pour ce projet.";
			require("views/empty.phtml");
		}
	}
	elseif(isset($_GET['id']) && $_GET['page'] == "mine")
	{
		var_dump("A FAIRE !");
	}
}
?>