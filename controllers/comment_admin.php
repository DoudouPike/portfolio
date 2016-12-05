<?php 

// var_dump($comment->getAuthor());
if((isset($_SESSION['id']) && $_SESSION['id'] == $comment->getAuthor()) || isset($_SESSION['admin']))
{
	require('views/comment_admin.phtml');
}
?>