<?php
if(isset($_GET['page']))
{
	if($_GET['page'] == 'mine')
	{
		$commentManager = new CommentManager($db);
		$list = $commentManager->findByProduct($product);
		if($list)
		{
			for ($i=0; $i < sizeof($list) ; $i++) { 
				$comment = $list[$i];
				require("views/comments.phtml");
			}
		}
		else
		{
			$empty = "Aucun commentaires pour ce produit.";
			require("views/empty.phtml");
		}
	}
	elseif($_GET['page'] == 'dashboard')
	{
		$commentManager = new CommentManager($db);
		$list = $commentManager->findByUser($user);
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
			$empty = "Vous n'avez posté aucun commentaire.";
			require("views/empty.phtml");
		}
	}
}

?>