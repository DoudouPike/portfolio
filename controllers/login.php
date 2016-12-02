<?php
	if(isset($_POST['login'], $_POST['email']))
	{
		$login = $_POST['login'];
	}
	else
	{
		$login = "";
	}
	require('views/login.phtml');
?>