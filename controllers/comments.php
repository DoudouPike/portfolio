<?php
if(isset($_GET['page']) && (($_GET['page'] == "dashboard") || isset($_GET['id'])))
	require('views/comments.phtml');
else
	require('views/404.phtml');
?>