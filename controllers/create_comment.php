<?php
if(isset($_SESSION['id']))
{
	$content = "";
	if(isset($_POST['content']))
		$content = $_POST['content'];
	if($_GET['page'] == "create_comment" && isset($_SESSION['admin']))
	{
		$projectManager = new ProjectManager($db);
		$project = $projectManager->findById($_GET['id']);
	}
	require("views/create_comment.phtml");
}
else
{
	$reason = "poster un commentaire";
	require("views/needLogin.phtml");
}
?>