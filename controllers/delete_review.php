<?php
if(isset($_GET['id']))
{
	$reviewManager = new ReviewManager($db);
	$review = $reviewManager->findById($_GET['id']);
	require("views/delete_review.phtml");
}
?>