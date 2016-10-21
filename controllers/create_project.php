<?php
$title = "";
$content = "";
$abstract = "";
$image= "";
$date = "";
$url = "";
if(isset($_POST))
{
	if(isset($_POST['title']))
		$title = $_POST['title'];
	if(isset($_POST['content']))
		$content = $_POST['content'];
	if(isset($_POST['abstract']))
		$abstract = $_POST['abstract'];
	if(isset($_POST['image']))
		$image = $_POST['image'];
	if(isset($_POST['url']))
		$url = $_POST['url'];
	if(isset($_POST['date']))
		$date = $_POST['date'];
}

require("views/create_project.phtml");
?>