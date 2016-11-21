<?php
session_start();

if($_SERVER['SERVER_NAME'] === "localhost")
{
	$host_name = "localhost";
	$database = "portfolio";
	$user_name = "root";
	$password = "root";
}
else
{
	$host_name  = "db655083596.db.1and1.com";
    $database   = "db655083596";
    $user_name  = "dbo655083596";
    $password   = "3WAportfolio";
}

$connect = mysqli_connect($host_name, $user_name, $password, $database);
if(!$connect)
{
	$error = "Echec de la connexion avec la base de donnée: ".mysqli_connect_error()."";    		
}
else
{
	$db = $connect;
}

function __autoload($className)
{
	require('models/'.$className.'.class.php');
}

$page = "home";
if(isset($_GET['admin'], $_SESSION['admin']) )
	$page= "home_back";

$access = ["about", "contact", "login", "mine", "portfolio", "register",];
$accessIn = ["about", "contact", "dashboard", "delete_user", "logout", "mine", "portfolio",];
$accessAdmin = ["about", "comments", "contact", "create_comment", "create_note", "create_prod", "create_project", "create_review", "dashboard", "delete_comment", "delete_note", "delete_prod", "delete_project", "delete_review", "delete_user", "delete_user_admin", "edit_note", "edit_prod", "edit_project", "edit_review", "edit_user", "home_back", "logout", "mine", "notes_back", "portfolio", "prods", "prods_admin", "projects", "projects_admin", "reviews", "users"];

if(isset($_GET['page']))
{
	if(isset($_SESSION['id']))
	{
		if(isset($_SESSION['admin']) && in_array($_GET['page'], $accessAdmin))
		{
			$page = $_GET['page'];
		}
		elseif(in_array($_GET['page'], $accessIn))
		{
			$page = $_GET['page'];
		}
	}
	elseif(in_array($_GET['page'], $access))
	{
		$page = $_GET['page'];
	}
	$pageName = ucfirst($page);
}

$traitementList = [
	"dashboard"=>"users", "delete_user"=>"users", "delete_user_admin"=>"users", "edit_user"=>"users", "login"=>"users", "logout"=>"users", "register"=>"users", "users"=>"users",
	"create_comment"=>"comments", "delete_comment"=>"comments",
	"create_note"=>"notes", "delete_note"=>"notes", "edit_note"=>"notes",
	"create_prod"=>"prods", "delete_prod"=>"prods", "edit_prod"=> "prods",
	"create_project"=>"projects", "delete_project"=>"projects", "edit_project"=>"projects",
	"create_review"=>"reviews", "delete_review"=>"reviews", "edit_review"=>"reviews"
];

if(isset($_GET['page'], $traitementList[$_GET['page']]))
	require("controllers/traitement_".$traitementList[$_GET['page']].".php");
// if (isset($_GET['ajax']))
// 	require('controllers/recherche_res.php');
// else
	require('controllers/skel.php');
?>