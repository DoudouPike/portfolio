<?php
if(isset($_GET['admin'], $_SESSION['admin'], $_GET['page']) && $_GET['page'] == "projects")
	require('views/review_admin.phtml');
?>