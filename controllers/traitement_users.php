<?php 
if(isset($_GET['page']) && $_GET['page'] == 'logout')
{
	session_destroy();
	session_start();
	$_SESSION['logoutSuccess'] = "";
	header('Location: index.php?page=home');
	exit;
}

if(isset($_POST['action']))
{
	$action = $_POST['action'];
	
	if($action == 'register' && isset($_POST['login'], $_POST['email'], $_POST['pwd'],$_POST['pwd2']))
	{
		$userManager = new UserManager($db);
		try
		{
			$userManager->create($_POST['login'], $_POST['email'], $_POST['pwd'], $_POST['pwd2']);

			$_SESSION['registerSuccess'] = "";
			header('Location: index.php?page=connection');
			exit;
		}
		catch(Exception $e)
		{
			$error = $e->getMessage();
		}

	}
	elseif($action == 'login' && isset($_POST['login'], $_POST['pwd']))
	{
		$userManager = new UserManager($db);
		$user = $userManager->findByLogin($_POST['login']);
		try
		{
			if(!$user)
				throw new Exception("Utilisateur introuvable");	
			if(!$user->verifPassword($_POST['pwd']))
				throw new Exception("Mot de passe incorrect");

			$_SESSION['id'] = $user->getId();
			$_SESSION['login'] = $user->getLogin();
			$_SESSION['loginSuccess'] = "";
			if($user->getAdmin() == "1")
				$_SESSION['admin'] = $user->getAdmin();
			header('Location: index.php?page=home');
			exit;
		}
		catch(Exception $e)
		{
			$error = $e->getMessage();
		}
	}
	elseif($action == 'update' && isset($_POST['email']))
	{
		$userManager = new UserManager($db);
		try
		{
			$user = $userManager->findById($_SESSION['id']);
			if(!$user)
				throw new Exception("Vous n'êtes plus connecté");
			
			$user->setEmail($_POST['email']);
			$userManager->save($user);
				
			header('Location: index.php?page=dashboard');
			exit;
		}
		catch(Exception $e)
		{
			$error = $e->getMessage();
		}
	}
	elseif($action == 'newPwd' && isset($_POST['actualPwd'], $_POST['newPwd'], $_POST['newPwd2']))
	{
		$userManager = new UserManager($db);
		try
		{
			$user = $userManager->findById($_SESSION['id']);
			if(!$user)
				throw new Exception("Vous n'êtes plus connecté");
			if(!$user->verifPassword($_POST['actualPwd']))
				throw new Exception("Mot de passe incorrect");

			$user->initPassword($_POST['newPwd'], $_POST['newPwd2']);
			$userManager->save($user);
				
			header('Location: index.php?page=dashboard');
			exit;
		}
		catch(Exception $e)
		{
			$error = $e->getMessage();
		}
	}
	elseif($action == "editAdmin" && isset($_POST['id'], $_POST['admin'], $_SESSION['admin']))
	{
		$userManager = new UserManager($db);
		try
		{
			$user = $userManager->findById($_POST['id']);
			if(!$user)
				throw new Exception("L'utilisateur n'existe pas");

			$user->setAdmin($_POST['admin']);
			$userManager->updateAdmin($user);
			header('Location: index.php?page=users#'.$user->getId());
		}
		catch (Exception $exception)
		{
			$error = $exception->getMessage();
		}
	}
	elseif($action == "delete")
	{
		$userManager = new UserManager($db);
		try
		{
			$user = $userManager->findById($_SESSION['id']);
			if(!$user)
				throw new Exception("Vous n'êtes plus connecté");

			$delete = $userManager->remove($user);
			session_destroy();
			header('Location: index.php');
			exit;
		}
		catch (Exception $exception)
		{
			$error = $exception->getMessage();
		}
	}
	elseif($action == "delete_admin" && isset($_POST['id'], $_SESSION['admin']))
	{
		$userManager = new UserManager($db);
		try
		{
			$user = $userManager->findById($_POST['id']);
			if(!$user)
				throw new Exception("L'utilisateur n'existe pas");
			if($user->getAdmin() == "1")
				throw new Exception("Impossible de supprimer un administrateur");
				
			$delete = $userManager->remove($user);
			header('Location: index.php?admin&page=users');
			exit;
		}
		catch (Exception $exception)
		{
			$error = $exception->getMessage();
		}
	}
}	
?>