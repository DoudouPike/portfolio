<?php
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
?>