<?php
session_start();

require('private/connectDB.php');
$connect = mysqli_connect($host_name, $user_name, $password, $database);
if(!$connect)
{
	$error = "Echec de connexion avec la base de donnée: ".mysqli_connect_error()."";	
}
else
{
	mysqli_set_charset($connect , "utf8");
	$db = $connect;
}

function __autoload($className)
{
	require('models/'.$className.'.class.php');
}

$title = "DoudouPike";
if(isset($_GET['admin']))
	$title = "BackOffice";

$page = "home";
if(isset($_GET['admin'], $_SESSION['admin']) )
	$page= "home_back";
$access = ["about", "contact", "connection", "mine", "portfolio"];
$accessIn = ["about", "contact", "dashboard", "logout", "mine", "portfolio",];
$accessAdmin = ["create_comment", "create_note", "create_prod", "create_project", "create_review", "delete_comment", "delete_note", "delete_prod", "delete_project", "delete_review", "delete_user", "edit_note", "edit_prod", "edit_project", "edit_review", "edit_user", "home_back", "notes_back", "prod_back", "project_back", "users"];
if(isset($_GET['page']))
{
	if(isset($_SESSION['id']))
	{
		if(isset($_SESSION['admin'], $_GET['admin']) && in_array($_GET['page'], $accessAdmin))
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
}

if($page == "home")
{
	$pageName = "Accueil";
	$pageDescription = "Kévin Pique alias DoudouPike, Développeur Web Front & Back en Alsace - Découvrez mes connaissances (HML, CSS, PHP, JavaScript, MySQL), mon parcours (3W Academy), mes réalisations et mes projets !";
	$ogURL = "http://doudoupike.fr/";
}
elseif($page == "about")
{
	$pageName = "À propos";
	$pageDescription = "À propos de moi : DoudouPike, Développeur Web en Alsace. Philosophie, Fight Club. Mes connaissances : HTML5, CSS3, PHP, JavaScript, jQuery, MySQL. Mon parcous : Formation 3W Academy.";
	$ogURL = "http://doudoupike.fr/index.php?page=about";
}
elseif($page == "portfolio")
{
	$pageName = "Mes réalisations";
	$pageDescription = "Découvrez mes réalisations dans les langages Web suivant : HTML, CSS, JavaScript, PHP";
	$ogURL = "http://doudoupike.fr/index.php?page=portfolio";
}
elseif($page == "mine")
{
	$pageName = "Mes projets";
	$pageDescription = "Découvrez mes projets et leurs actualités, postez des commentaires.";
	$ogURL = "http://doudoupike.fr/index.php?page=mine";
}
elseif($page == "contact")
{
	$pageName = "Me contacter";
	$pageDescription = "Un poste à proposer ? Besoin d'un site ? Une question sur mon travail ? Besoin d'aide pour réaliser un projet ? N'hésitez pas à me contacter !";
	$ogURL = "http://doudoupike.fr/index.php?page=contact";
}
elseif($page == "connection")
{
	$pageName = "Se connecter";
	$pageDescription = "Connectez-vous pour pouvoir poster des commentaires. Connexion sécurisée, accedez librement à vos informations pour les modifier ou les supprimer.";
	$ogURL = "http://doudoupike.fr/index.php?page=connection";
}
elseif($page == "dashboard")
{
	$pageName = "Mon compte";
	$pageDescription = "Modifier mon compte ou le supprimer. Voir la liste des commentaires que j'ai posté.";
	$ogURL = "http://doudoupike.fr/index.php?page=dashboard";
}
else
{
	$pageName = "";
	$pageDescription = "Kévin Pique alias DoudouPike, Développeur Web Front & Back en Alsace";
	$ogURL = "http://doudoupike.fr/";
}


$traitementList = [
	"dashboard"=>"users", "delete_user"=>"users", "delete_user_admin"=>"users", "edit_user"=>"users", "connection"=>"users", "logout"=>"users", "users"=>"users",
	"create_comment"=>"comments", "delete_comment"=>"comments", "mine"=>"comments",
	"create_note"=>"notes", "delete_note"=>"notes", "edit_note"=>"notes",
	"create_prod"=>"prods", "delete_prod"=>"prods", "edit_prod"=> "prods",
	"create_project"=>"projects", "delete_project"=>"projects", "edit_project"=>"projects",
	"create_review"=>"reviews", "delete_review"=>"reviews", "edit_review"=>"reviews",
	"contact"=>"contact"
];
if(isset($_GET['page'], $traitementList[$_GET['page']]))
	require("controllers/traitement_".$traitementList[$_GET['page']].".php");

require('controllers/skel.php');
?>