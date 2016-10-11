<?php
if(isset($_GET['admin'], $_SESSION['admin']))
	require("views/menu_admin.phtml");
else
	require("views/menu.phtml");
?>