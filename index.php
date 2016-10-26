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
	$accessAdmin = ["about", "comments", "contact", "create_comment","create_note", "create_prod", "create_project", "create_review", "dashboard", "delete_comment", "delete_note", "delete_prod", "delete_project", "delete_review","edit_note", "edit_prod", "edit_project", "edit_review", "edit_user", "logout", "mine", "notes", "portfolio", "prods", "prods_admin", "projects", "projects_admin", "reviews", "users"];
	
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
		"dashboard" => "users", "login" => "users", "logout" => "users", "register" => "users", "users" => "users",
		"create_comment" => "comments", "delete_comment" => "comments",
		"create_note" => "notes", "delete_note" => "notes", "edit_note" => "notes",
		"create_prod" => "prods", "delete_prod" => "prods", "edit_prod" => "prods",
		"create_project" => "projects", "delete_project" => "projects", "edit_project" => "projects",
		"create_review" => "reviews", "delete_review" => "reviews", "edit_review" => "reviews"
	];
	
	if(isset($_GET['page'], $traitementList[$_GET['page']]))
		require("controllers/traitement_".$traitementList[$_GET['page']].".php");
	if (isset($_GET['ajax']))
		require('controllers/recherche_res.php');
	else
		require('controllers/skel.php');
?>