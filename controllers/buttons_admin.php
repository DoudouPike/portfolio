<?php
if(isset($_GET['admin'], $_GET['page'], $_SESSION['admin']))
{
	if($_GET['page'] == "notes")
		$element = "note";
	elseif($_GET['page'] == "prods")
		$element = "prod";
	elseif($_GET['page'] == "projects")
		$element = "project";

	require("views/buttons_admin.phtml");
}
	
?>