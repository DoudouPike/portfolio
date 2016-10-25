<?php
$content = "";
if(isset($_POST['content']))
	$content = $_POST['content'];
require("views/create_comment.phtml");
?>