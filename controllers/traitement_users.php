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
			if(!preg_match("#^[a-z0-9._-]+@(hotmail|live|msn).[a-z]{2,4}$#", $_POST['email']))
			{
				$return = "\r\n";
			}
			else
			{
				$return = "\n";
			}
			$boundary = "-----=".md5(rand());
			$id = uniqid();
			$object = "[DoudouPike] - Confirmation d'inscription";
			$content = "
			<html>
				<head>
					<title>Confirmation d'inscription</title>
				</head>
				<body>
					<p>Bonjour ".$_POST['login'].",</p>
					<p>Cliquez sur le lien ci dessous pour confirmer votre inscription au site <a href=\"http://doudoupike.fr\">doudoupike.fr</a>.</p>
					<p><a href=\"http://doudoupike.fr/index.php?page=connection&log=".urlencode($_POST['login'])."&id=".$id."\">Confirmer mon inscription</a></p>
				</body>
			</html>";

			$header = 'From: "DoudouPike" <contact@doudoupike.fr>'.$return;
			$header .= 'Reply-to: "'.$_POST['login'].'" <'.$_POST['email'].'>'.$return;
			$header .= "MIME-Version: 1.0".$return;
			$header .= "X-Priority: 2".$return;
			$header .= "Content-Type: multipart/alternative;".$return." boundary=\"$boundary\"".$return;

			$message = $return."--".$boundary.$return;
			$message .= "Content-Type: text/html; charset=\"UTF-8\"".$return;
			$message .= "Content-Transfer-Encoding: 8bits".$return;
			$message .= $return.$content.$return;
			$message .= $return."--".$boundary."--".$return;

			$mail = mail($_POST['email'], $object, $message, $header);
			if(!$mail)
			{
				throw new Exception("Erreur lors de l'envoi du message. Contactez moi via contact@doudoupike.fr");
			}
			$_SESSION['successBeforeReg'] = "";
			$_SESSION['uniqid'] = $id;
			header('Location: index.php?page=connection&confirm');
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
			if($user->getActive() == "0")
				throw new Exception("Votre compte n'est pas activé, vérifiez vos mails.");

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
			
			$_SESSION['successUpdate'] = "";

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

			session_destroy();

			session_start();
			$_SESSION['successNewPwd'] = "";

			header('Location: index.php?page=connection');
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
			header('Location: index.php?admin&page=users#'.$user->getId());
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