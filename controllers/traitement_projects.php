<?php
if(isset($_POST["action"]))
{
	$action = $_POST['action'];

	if($action == 'create' && (isset($_POST['title'], $_POST['content'], $_POST['image'], $_POST['url'], $_POST['date'], $_SESSION['id'], $_SESSION['admin'])))
	{
		$userManager = new UserManager($db);
		$projectManager = new ProjectManager($db);
		try
		{
			$user = $userManager->findById($_SESSION['id']);
			if (!$user)
				throw new Exception("Vous n'êtes plus connecté");

			$project = $projectManager->create($_POST['title'], $_POST['content'], $_POST['image'], $_POST['url'], $_POST['date']);
			if(!$project)
				throw new Exception("Erreur interne");
			header('Location: index.php?admin&page=project_back#'.$project->getId().'');
			exit;
			
		}
		catch (Exception $exception)
		{
			$error = $exception->getMessage();
		}
	}
	elseif($action == "edit" && (isset($_POST['id'], $_POST['title'], $_POST['content'], $_POST['image'], $_POST['url'], $_POST['date'], $_SESSION['id'], $_SESSION['admin'])))
	{
		$userManager = new UserManager($db);
		$projectManager = new ProjectManager($db);
		try
		{
			$user = $userManager->findById($_SESSION['id']);
			if (!$user)
				throw new Exception("Vous n'êtes plus connecté");

			$project = $projectManager->findById($_POST['id']);
			$project->setTitle($_POST['title']);
			$project->setContent($_POST['content']);
			$project->setImage($_POST['image']);
			$project->setUrl($_POST['url']);
			$project->setDate($_POST['date']);
			$project = $projectManager->save($project);
			if(!$project)
				throw new Exception("Erreur interne");
			header('Location: index.php?admin&page=project_back#'.$project->getId().'');
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
		$projectManager = new ProjectManager($db);
		try
		{
			$user = $userManager->findById($_SESSION['id']);
			if(!$user)
				throw new Exception("Vous n'êtes plus connecté");

			$project = $projectManager->findById($_POST['id']);
			if(!$project)
				throw new Exception("Ce projet n'existe pas");

			$delete = $projectManager->remove($project);
			if($delete != null)
				throw new Exception("Erreur interne");

			header('Location: index.php?admin&page=project_back');
			exit;
		}
		catch (Exception $exception)
		{
			$error = $exception->getMessage();
		}
	}
}
?>