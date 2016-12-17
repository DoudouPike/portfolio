<?php
if(isset($_POST["action"]))
{
	$action = $_POST['action'];

	if($action == 'create' && (isset($_POST['id_project'], $_POST['content'], $_SESSION['id'])))
	{
		$projectManager = new ProjectManager($db);
		$userManager = new UserManager($db);
		$commentManager = new CommentManager($db);
		try
		{
			$project = $projectManager->findById($_POST['id_project']);
			if(!$project)
				throw new Exception("Le projet n'existe pas.");		

			$author = $userManager->findById($_SESSION['id']);
			if(!$author)
				throw new Exception("Vous n'êtes plus connecté.");

			$comment = $commentManager->create($project, $author, $_POST['content']);
			if(!$comment)
				throw new Exception("Erreur interne");

			if($_GET['page'] == "create_comment")
				header('Location: index.php?admin&page=project_back#'.$project->getId().'');
			elseif($_GET['page'] == "mine")
				header('Location: index.php?page=mine&id='.$project->getId().'#'.$comment->getId().'');

			exit;
			
		}
		catch (Exception $exception)
		{
			$error = $exception->getMessage();
		}
	}
	elseif($action == "delete" && (isset($_POST["id"], $_SESSION['id'])))
	{
		$userManager = new UserManager($db);
		$commentManager = new CommentManager($db);
		try
		{
			$user = $userManager->findById($_SESSION['id']);
			if(!$user)
				throw new Exception("Vous n'êtes plus connecté.");

			$comment = $commentManager->findById($_POST['id']);
			if(!$comment)
				throw new Exception("Ce commentaire n'existe pas");

			$commentManager -> remove($comment);
			if($_GET['page'] == "delete_comment")
				header('Location: index.php?admin&page=project_back#'.$comment->getProject()->getId());
			elseif($_GET['page'] == "mine")
				header('Location: index.php?page=mine&id='.$comment->getProject()->getId());
			exit;
		}
		catch (Exception $exception)
		{
			$error = $exception->getMessage();
		}
	}	
}
?>