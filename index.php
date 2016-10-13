<?php

	session_start();
	$db = mysqli_connect("localhost", "root", "toQwEu192", "portfolio");
	
	$empty = "";
	function __autoload($className)
	{
		require('models/'.$className.'.class.php');
	}
	
	$error = '';
	$page = "home";
	$access = ["about", "portfolio", "mine", "contact", "register", "login"];
	$accessIn = ["about", "contact", "portfolio", "mine", "logout", "dashboard"];
	$accessAdmin = ["about", "contact", "create_note", "portfolio", "dashboard", "logout", "mine", "notes", "notes_admin", "prods_admin", "projects_admin"];
	
	if(isset($_GET['page']))
	{
		if(isset($_SESSION['id']))
		{
			if(isset($_SESSION['admin']) && in_array($_GET['page'], $accessAdmin))
			{
				$page = $_GET['page'];
			}
			else if (in_array($_GET['page'], $accessIn))
			{
				$page = $_GET['page'];
			}
		}
		else if(in_array($_GET['page'], $access))
		{
			$page = $_GET['page'];
		}
	}
	
	$traitementList = [
		"register" => "users", "login" => "users", "logout" => "users", "dashboard" => "users",
		"create_note" => "notes"
	];
	
	if(isset($_GET['page'], $traitementList[$_GET['page']]))
		require("controllers/traitement_".$traitementList[$_GET['page']].".php");
	if (isset($_GET['ajax']))
		require('controllers/recherche_res.php');
	else
		require('controllers/skel.php');
?>