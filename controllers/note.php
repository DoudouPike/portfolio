<?php
$noteManager = new NoteManager($db);
$list = $noteManager->findActive();
for ($i=0; $i < sizeof($list); $i++)
{
	$note = $list[$i];
	require("views/note.phtml");
}
?>