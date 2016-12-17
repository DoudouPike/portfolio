<?php
if(isset($_SESSION['id']))
	require('views/contact_login.phtml');
else
	require('views/contact_anonymous.phtml');
?>