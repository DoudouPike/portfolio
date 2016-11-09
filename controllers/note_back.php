<?php
$noteManager = new NoteManager($db);
$list = $noteManager->findAll();
for ($i=0; $i < sizeof($list); $i++)
{
	$note = $list[$i];
	if($note->getActive() == "0")
		$active = "Cachée";
	elseif($note->getActive() == "1")
		$active = "Affichée";

	require("views/note_back.phtml");
}
?>