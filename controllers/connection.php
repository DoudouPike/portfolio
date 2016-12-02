<?php
if(isset($_SESSION['registerSuccess']))
{
	require('views/successRegister.phtml');
	unset($_SESSION['registerSuccess']);
}
require('views/connection.phtml');
?>