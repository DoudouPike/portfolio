<?php
if(isset($_POST["action"]))
{
	$action = $_POST['action'];

	if($action == 'create' && (isset($_POST['title'], $_POST['description'], $_POST['image'], $_POST['client'], $_POST['url'], $_POST['date'], $_SESSION['id'], $_SESSION['admin'])))
	{
		$userManager = new UserManager($db);
		$prodManager = new ProdManager($db);
		try
		{
			$user = $userManager->findById($_SESSION['id']);
			if (!$user)
				throw new Exception("Vous n'êtes plus connecté");

			$prod = $prodManager->create($_POST['title'], $_POST['description'], $_POST['image'], $_POST['url'], $_POST['client'], $_POST['date']);
			if(!$prod)
				throw new Exception("Erreur interne");
			header('Location: index.php?admin&page=prod_back#'.$prod->getId().'');
			exit;
			
		}
		catch (Exception $exception)
		{
			$error = $exception->getMessage();
		}
	}
	elseif($action == "edit" && (isset($_POST['id'], $_POST['title'], $_POST['description'], $_POST['image'], $_POST['url'], $_POST['client'], $_POST['date'], $_SESSION['id'], $_SESSION['admin'])))
	{
		$userManager = new UserManager($db);
		$prodManager = new ProdManager($db);
		try
		{
			$user = $userManager->findById($_SESSION['id']);
			if (!$user)
				throw new Exception("Vous n'êtes plus connecté");

			$prod = $prodManager->findById($_POST['id']);
			$prod->setTitle($_POST['title']);
			$prod->setDescription($_POST['description']);
			$prod->setImage($_POST['image']);
			$prod->setUrl($_POST['url']);
			$prod->setClient($_POST['client']);
			$prod->setDate($_POST['date']);
			$prod = $prodManager->save($prod);
			if(!$prod)
				throw new Exception("Erreur interne");
			header('Location: index.php?admin&page=prod_back#'.$prod->getId().'');
			exit;
			
		}
		catch (Exception $exception)
		{
			$error = $exception->getMessage();
		}
	}
	elseif($action == "delete" && (isset($_POST['id'], $_SESSION['id'], $_SESSION['admin'])))
	{
		$userManager = new UserManager($db);
		$prodManager = new ProdManager($db);
		try
		{
			$user = $userManager->findById($_SESSION['id']);
			if(!$user)
				throw new Exception("Vous n'êtes plus connecté");

			$prod = $prodManager->findById($_POST['id']);
			if(!$prod)
				throw new Exception("Cette réalisation n'existe pas");

			$delete = $prodManager->remove($prod);
			if($delete != null)
				throw new Exception("Erreur interne");

			header('Location: index.php?admin&page=prod_back');
			exit;
		}
		catch (Exception $exception)
		{
			$error = $exception->getMessage();
		}
	}
}
?>