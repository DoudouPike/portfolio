<?php
if(isset($_POST["action"]))
{
	$action = $_POST['action'];

	if($action == 'create' && (isset($_POST['content'], $_POST['active'], $_SESSION['id'], $_SESSION['id'], $_SESSION['admin'])))
	{
		$userManager = new UserManager($db);
		$noteManager = new NoteManager($db);
		try
		{
			$user = $userManager->findById($_SESSION['id']);
			if (!$user)
				throw new Exception("Vous n'êtes plus connecté");

			$note = $noteManager->create($_POST['content'],$_POST['active']);
			if(!$note)
				throw new Exception("Erreur interne");
			header('Location: index.php?admin&page=notes_back#'.$note->getId().'');
			exit;
			
		}
		catch (Exception $exception)
		{
			$error = $exception->getMessage();
		}
	}
	elseif($action == "edit" && (isset($_POST['id'], $_POST['content'], $_POST['active'], $_SESSION['id'], $_SESSION['admin'])))
	{
		$userManager = new UserManager($db);
		$noteManager = new NoteManager($db);
		try
		{
			$user = $userManager->findById($_SESSION['id']);
			if (!$user)
				throw new Exception("Vous n'êtes plus connecté");

			$note = $noteManager->findById($_POST['id']);
			$note->setContent($_POST['content']);
			$note->setActive($_POST['active']);
			$note = $noteManager->save($note);
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
	elseif($action == "delete" && (isset($_POST['id'], $_SESSION['id'], $_SESSION['admin'])))
	{
		$userManager = new UserManager($db);
		$noteManager = new NoteManager($db);
		try
		{
			$user = $userManager->findById($_SESSION['id']);
			if(!$user)
				throw new Exception("Vous n'êtes plus connecté");

			$note = $noteManager->findById($_POST['id']);
			if(!$note)
				throw new Exception("Cette note n'existe pas");

			$delete = $noteManager->remove($note);
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
?>