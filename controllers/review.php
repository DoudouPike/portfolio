<?php
$reviewManager = new ReviewManager($db);
$list = $reviewManager->findByProject($tabs[$i]);
if($list)
{
	for ($j=0; $j < sizeof($list) ; $j++)
	{ 
		$review = $list[$j];
		require("views/review_back.phtml");
	}
}
else
{
	$empty = "Aucune nouveauté pour ce projet.";
	require("views/empty.phtml");
}
?>