<?php
$commentManager = new CommentManager($db);
$comments = $commentManager->findByProject($project);
if($comments)
{
	for ($j=0; $j < sizeof($comments); $j++)
	{ 
		$comment = $comments[$j];
		require("views/comment_back.phtml");
	}
}
else
{
	$empty = "Aucun commentaire pour ce projet.";
	require("views/empty.phtml");
}
?>