<?php
if(isset($_POST["action"]))
{
	$action = $_POST['action'];

	if($action == 'create')
	{
		if(isset($_POST['id_project'], $_POST['title'], $_POST['content'], $_SESSION['id'], $_SESSION['admin']))
		{
			$userManager = new UserManager($db);
			$projectManager = new ProjectManager($db);
			$reviewManager = new ReviewManager($db);
			try
			{
				$user = $userManager->findById($_SESSION['id']);
				if(!$user)
					throw new Exception("Vous n'êtes plus connecté");
				
				$project = $projectManager->findById($_POST['id_project']);
				if(!$project)
					throw new Exception("Le projet n'existe pas");
	
				$review = $reviewManager->create($project, $_POST['title'], $_POST['content']);
				if(!$review)
					throw new Exception("Erreur interne");
				header('Location: index.php?admin&page=projects#'.$project->getId().'');
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
		if(isset($_POST['id'], $_POST['title'], $_POST['content'], $_SESSION['id'], $_SESSION['admin']))
		{
			$userManager = new UserManager($db);
			$reviewManager = new ReviewManager($db);
			try
			{
				$user = $userManager->findById($_SESSION['id']);
				if (!$user)
					throw new Exception("Vous n'êtes plus connecté");

				$review = $reviewManager->findById($_POST['id']);
				$review->setTitle($_POST['title']);
				$review->setContent($_POST['content']);
				$review = $reviewManager->save($review);
				if(!$review)
					throw new Exception("Erreur interne");
				header('Location: index.php?admin&page=projects#'.$review->getProject()->getId().'');
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
		if(isset($_POST['id'], $_SESSION['id'], $_SESSION['admin']))
		{
			$userManager = new UserManager($db);
			$reviewManager = new ReviewManager($db);
			try
			{
				$user = $userManager->findById($_SESSION['id']);
				if(!$user)
					throw new Exception("Vous n'êtes plus connecté");

				$review = $reviewManager->findById($_POST['id']);
				if(!$review)
					throw new Exception("Cette réalisation n'existe pas");

				$delete = $reviewManager->remove($review);
				if($delete != null)
					throw new Exception("Erreur interne");

				header('Location: index.php?admin&page=projects');
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