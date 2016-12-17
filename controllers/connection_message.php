<?php
if(isset($_GET['register']) || isset($_GET['confirm']))
{
	require("views/connection_rm.phtml");
}
else
{
	require("views/connection_lm.phtml");
}
?>