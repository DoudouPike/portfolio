<?php
if(isset($_SESSION['id']))
{
	$content = "";
	if(isset($_POST['content']))
		$content = $_POST['content'];
	require("views/create_comment.phtml");
}
else
{
	$reason = "poster un commentaire";
	require("views/needLogin.phtml");
}
?>