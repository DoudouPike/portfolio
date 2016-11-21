<?php
$title = "DoudouPike";
if(isset($_GET['admin']))
	$title = "BackOffice";
require('views/skel.phtml');
?>