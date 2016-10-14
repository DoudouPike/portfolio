<?php
if(isset($_POST["action"]))
{
	$userManager = new UserManager($db);
	$noteManager = new NoteManager($db);
	$action = $_POST['action'];

	if($action == 'create')
	{
		if(isset($_POST['content'], $_POST['active'], $_SESSION['id'], $_SESSION['admin']))
		{
			try
			{
				$user = $userManager->findById($_SESSION['id']);
				if (!$user)
					throw new Exception("Vous n'êtes plus connecté");

				$create = $noteManager->create($_POST['content'],$_POST['active']);
				if (!$note)
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
	elseif($action == "edit")
	{
		var_dump($_POST);
		if(isset($_POST['id'], $_POST['content'], $_POST['active'], $_SESSION['admin']))
		{
			try
			{
				$user = $userManager->findById($_SESSION['id']);
				if (!$user)
					throw new Exception("Vous n'êtes plus connecté");

				$note = $noteManager->findById($_POST['id']);
				$note->setContent($_POST['content']);
				$note->setActive($_POST['active']);
				$save = $noteManager->save($note);
				if (!$note)
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
}
?>