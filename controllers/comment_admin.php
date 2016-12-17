<?php 
if((isset($_SESSION['login']) && $_SESSION['login'] == $comment->getAuthor()->getLogin()))
{
	require('views/comment_admin.phtml');
}
?>