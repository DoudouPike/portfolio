<?php
if(isset($_GET['admin'], $_SESSION['admin']))
{
	require("views/backoffice.phtml");
}
else
{
	require("views/public.phtml");
}
?>