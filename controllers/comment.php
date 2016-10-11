<?php

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

?>