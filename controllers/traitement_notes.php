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
			var_dump($_POST);
			try
			{
				$user = $userManager->findById($_SESSION['id']);
				if (!$user)
					throw new Exception("Vous n'êtes plus connecté");

				$note = $noteManager->create($_POST['content'],$_POST['active']);
				if (!$note)
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