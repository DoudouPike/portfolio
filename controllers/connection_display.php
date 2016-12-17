<?php
if(isset($_GET['confirm']))
{
	require('views/confirmation.phtml');
}
elseif(isset($_GET['register']))
{
	if(isset($_POST['login'], $_POST['email']))
	{
		$login = $_POST['login'];
		$email = $_POST['email'];
	}
	else
	{
		$login = "";
		$email = "";
	}
	require('views/register.phtml');
}
else
{
	if(isset($_POST['login'], $_POST['email']))
	{
		$login = $_POST['login'];
	}
	else
	{
		$login = "";
	}
	require('views/login.phtml');
}
?>