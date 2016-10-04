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
	$access = ["about", "register", "login", "portfolio", "mine"];
	$accessIn = ["about", "contact", "portfolio", "mine", "logout", "dashboard"];
	$accessAdmin = ["about", "contact", "portfolio", "mine", "logout", "dashboard"];
	
	if(isset($_GET['page']))
	{
		if(isset($_SESSION['id']))
		{
			if(isset($_SESSION['admin']) && ($_SESSION['admin'] == "1") && in_array($_GET['page'], $accessAdmin))
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
		"register" => "users", "login" => "users", "logout" => "users",
		"create_product" => "product", "edit_product" => "product", "remove_product" => "product",
		"product_single" => "comments",
		"create_category" => "category", "products" => "category",
		"create_facture" => "facture", "panier" => "facture"
	];
	
	if(isset($_GET['page'], $traitementList[$_GET['page']]))
		require("controllers/traitement_".$traitementList[$_GET['page']].".php");
	if (isset($_GET['ajax']))
		require('controllers/recherche_res.php');
	else
		require('controllers/skel.php');
?>