<?php
if(isset($_POST["action"]))
{
	$action = $_POST['action'];

	if($action == 'create')
	{
		if(isset($_POST['title'], $_POST['description'], $_POST['image'], $_POST['url'], $_POST['date'], $_POST['altFormat'], $_SESSION['admin']))
		{
			$userManager = new UserManager($db);
			$prodManager = new ProdManager($db);
			try
			{
				$user = $userManager->findById($_SESSION['id']);
				if (!$user)
					throw new Exception("Vous n'êtes plus connecté");

				$prod = $prodManager->create($_POST['title'], $_POST['description'], $_POST['image'], $_POST['url'], $_POST['client'], $_POST['altFormat']);
				if(!$prod)
					throw new Exception("Erreur interne");
				header('Location: index.php?admin&page=prods#'.$prod->getId().'');
				exit;
				
			}
			catch (Exception $exception)
			{
				$error = $exception->getMessage();
			}
		}
	}
	elseif($action == "edit")
	{
		if(isset($_POST['id'], $_POST['content'], $_POST['active'], $_SESSION['admin']))
		{
			$userManager = new UserManager($db);
			$prodManager = new ProdManager($db);
			try
			{
				$user = $userManager->findById($_SESSION['id']);
				if (!$user)
					throw new Exception("Vous n'êtes plus connecté");

				$note = $prodManager->findById($_POST['id']);
				$note->setContent($_POST['content']);
				$note->setActive($_POST['active']);
				$note = $prodManager->save($note);
				if(!$note)
					throw new Exception("Erreur interne");
				header('Location: index.php?admin&page=notes#'.$note->getId().'');
				exit;
				
			}
			catch (Exception $exception)
			{
				$error = $exception->getMessage();
			}
		}
	}
	elseif($action == "delete")
	{
		if(isset($_POST['id'], $_SESSION['admin']))
		{
			$userManager = new UserManager($db);
			$prodManager = new ProdManager($db);
			try
			{
				$user = $userManager->findById($_SESSION['id']);
				if(!$user)
					throw new Exception("Vous n'êtes plus connecté");

				$note = $prodManager->findById($_POST['id']);
				if(!$note)
					throw new Exception("Cette note n'existe pas");

				$delete = $prodManager->remove($note);
				if($delete != null)
					throw new Exception("Erreur interne");

				header('Location: index.php?admin&page=notes');
				exit;
			}
			catch (Exception $exception)
			{
				$error = $exception->getMessage();
			}
		}
	}
}
?>