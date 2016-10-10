<?php
if(isset($_SESSION['id']))
{
	require("views/panel_in.phtml");
}
else
	require("views/panel.phtml");
?>