<?php
if(isset($_GET['id']))
{
	$noteManager = new NoteManager($db);
	$note = $noteManager->findById($_GET['id']);
	require("views/delete_note.phtml");
}
?>