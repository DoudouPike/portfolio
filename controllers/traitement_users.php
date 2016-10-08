<?php 
if(isset($_GET['page']) && $_GET['page'] == 'logout') {
	session_destroy();
	header('Location: index.php');
	exit;
}

if(isset($_POST['action']))
{
	$manager = new UserManager($db);
	$action = $_POST['action'];
	
	if($action == 'register' && isset($_POST['login'], $_POST['email'], $_POST['pwd'],$_POST['pwd2']))
	{
		try
		{

			if($_POST['pwd'] !== $_POST['pwd2'])
			{
				throw new Exception("Les mots de passe ne correspondent pas");
			}
			$user = $manager -> create($_POST['login'], $_POST['email'], $_POST['pwd']);
			header('Location: index.php?page=login');
			exit;
		}
		catch(Exception $e)
		{
			$error = $e -> getMessage();
		}

	}
	elseif($action == 'login' && isset($_POST['login'], $_POST['password']))
	{
		$manager = new UserManager($db);
		$user = $manager->findByLogin($_POST['login']);
		if ($user)
		{
			if ($user->verifPassword($_POST['password']))
			{
				$_SESSION['id'] = $user->getId();
				$_SESSION['user'] = $user;
				header('Location: index.php?page=home');
				exit;
			}
			else
				$_SESSION['error'] = 'Mauvais mot de passe';
		}
		else
			$_SESSION['error'] = 'Utilisateur introuvable';
	}
}	
?>