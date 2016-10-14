<?php
if(isset($_GET['id']))
	$noteManager = new NoteManager($db);
	$note = $noteManager->findById($_GET['id']);

	$hide = "";
	$show = "";

	if($note->getActive() == "0")
		$hide = "checked";
	elseif($note->getActive() == "1")
		$show = "checked";
	
	require("views/edit_note.phtml");
?>