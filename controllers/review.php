<?php
$reviewManager = new ReviewManager($db);
$reviews = $reviewManager->findByProject($project);
if($list)
{
	for ($j=0; $j < sizeof($list) ; $j++)
	{ 
		$review = $list[$j];
		require("views/review.phtml");
	}
}
else
{
	$empty = "Aucune nouveauté pour ce projet.";
	require("views/empty.phtml");
}
?>