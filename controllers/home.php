<?php
if(isset($_GET['admin']))
	require('views/home_back.phtml');
else
	require('views/home.phtml');
?>