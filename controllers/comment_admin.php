<?php 
if((isset($_SESSION['login']) && $_SESSION['login'] == $comment->getAuthor()->getLogin()))
{
	require('views/comment_admin.phtml');
}
elseif(isset($_GET['admin'], $_SESSION['admin']))
	require('views/comment_admin_back.phtml');
?>