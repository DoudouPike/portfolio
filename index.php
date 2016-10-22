<?php

	session_start();
	$db = mysqli_connect("localhost", "root", "root", "portfolio");
	
	$empty = "";
	function __autoload($className)
	{
		require('models/'.$className.'.class.php');
	}
	
	$error = '';
	$page = "home";
	$access = ["about", "contact", "login", "mine", "portfolio", "register",];
	$accessIn = ["about", "contact", "dashboard", "logout", "mine", "portfolio",];
	$accessAdmin = ["about", "comments", "contact", "create_note", "create_prod", "create_project", "dashboard", "delete_note", "delete_prod", "edit_note", "edit_prod", "logout", "mine", "notes", "portfolio", "prods", "prods_admin", "projects", "projects_admin", "reviews"];
	
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
		"dashboard" => "users", "login" => "users", "logout" => "users", "register" => "users",
		"create_note" => "notes", "delete_note" => "notes", "edit_note" => "notes",
		"create_prod" => "prods", "delete_prod" => "prods", "edit_prod" => "prods",
		"create_project" => "projects"
	];
	
	if(isset($_GET['page'], $traitementList[$_GET['page']]))
		require("controllers/traitement_".$traitementList[$_GET['page']].".php");
	if (isset($_GET['ajax']))
		require('controllers/recherche_res.php');
	else
		require('controllers/skel.php');
?>