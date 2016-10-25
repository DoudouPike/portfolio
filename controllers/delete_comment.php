<?php
if(isset($_GET['id']))
{
	$commentManager = new CommentManager($db);
	$comment = $commentManager->findById($_GET['id']);
	require("views/delete_comment.phtml");
}
?>