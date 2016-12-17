<?php
$reviewManager = new ReviewManager($db);
$reviews = $reviewManager->findByProject($project);
if($reviews)
{
	for ($j=0; $j < sizeof($reviews) ; $j++)
	{ 
		$review = $reviews[$j];
		require('views/review_back.phtml');
	}
}
else
{
	$empty = "Aucune nouveauté pour ce projet.";
	require("views/empty.phtml");
}
?>