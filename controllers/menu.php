<?php
if(isset($_GET['admin'], $_SESSION['admin']))
	require("views/menu_back.phtml");
else
	require("views/menu.phtml");
?>