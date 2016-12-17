<?php
if(isset($_GET['page']))
{
	if($_GET['page'] == "dashboard")
	{
		$commentManager = new CommentManager($db);
		$comments = $commentManager->findByUser($user);
		if($comments)
		{
			$projectManager = new ProjectManager($db);
			for ($j=0; $j < sizeof($comments); $j++)
			{ 
				$comment = $comments[$j];
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
	elseif($_GET['page'] == "mine")
	{
		$commentManager = new CommentManager($db);
		$comments = $commentManager->findByProject($project);
		if($comments)
		{
			for ($j=0; $j < sizeof($comments); $j++)
			{ 
				$comment = $comments[$j];
				require("views/comment.phtml");
			}
		}
		else
		{
			$empty = "Aucun commentaire pour ce projet.";
			require("views/empty.phtml");
		}
	}
}
?>