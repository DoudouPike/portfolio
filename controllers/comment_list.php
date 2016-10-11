<?php
$commentManager = new CommentManager($db);
$list = $commentManager->findByUser($user);
if($list)
{
	for ($i=0; $i < sizeof($list) ; $i++)
	{ 
		$comment = $list[$i];
		require("views/comment_list.phtml");
	}
}
else
{
	$empty = "Vous n'avez posté aucun commentaire.";
	require("views/empty.phtml");
}
?>