<?php 
if(isset($_GET['page']) && $_GET['page'] == 'logout')
{
	session_destroy();
	header('Location: index.php');
	exit;
}

if(isset($_POST['action']))
{
	$action = $_POST['action'];
	
	if($action == 'register' && isset($_POST['login'], $_POST['email'], $_POST['pwd'],$_POST['pwd2']))
	{
		$manager = new UserManager($db);
		try
		{
			$user = $manager->create($_POST['login'], $_POST['email'], $_POST['pwd'], $_POST['pwd2']);
			header('Location: index.php?page=login');
			exit;
		}
		catch(Exception $e)
		{
			$error = $e->getMessage();
		}

	}
	elseif($action == 'login' && isset($_POST['login'], $_POST['pwd']))
	{
		$manager = new UserManager($db);
		$user = $manager->findByLogin($_POST['login']);
		try
		{
			if(!$user)
				throw new Exception("Utilisateur introuvable");
				
			if(!$user->verifPassword($_POST['pwd']))
				throw new Exception("Mot de passe incorrect");

			$_SESSION['id'] = $user->getId();
			$_SESSION['user'] = $user;
			header('Location: index.php?page=home');
			exit;
		}
		catch(Exception $e)
		{
			$error = $e->getMessage();
		}
	}
}	
?>