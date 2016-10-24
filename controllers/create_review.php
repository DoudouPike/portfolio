<?php
if(isset($_GET['id']))
{
	$title = "";
	$content = "";
	$date = "";
	if(isset($_POST['title']))
		$title = $_POST['title'];
	if(isset($_POST['content']))
		$content = $_POST['content'];
	if(isset($_POST['date']))
		$date = $_POST['date'];
	require('views/create_review.phtml');	
}
?>