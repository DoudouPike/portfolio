<?php
$title = "";
$description = "";
$image= "";
$date = "";
$url = "";
$client = "";
if(isset($_POST['title']))
	$title = $_POST['title'];
if(isset($_POST['description']))
	$description = $_POST['description'];
if(isset($_POST['date']))
	$date = $_POST['date'];
if(isset($_POST['url']))
	$url = $_POST['url'];
if(isset($_POST['client']))
	$client = $_POST['client'];
require("views/create_prod.phtml");
?>