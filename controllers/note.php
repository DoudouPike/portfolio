<?php
$noteManager = new NoteManager($db);

if(isset($_GET['admin']))
	$notes = $noteManager->findAll();
else
	$notes = $notesManager->findActive();

for ($i=0; $i < sizeof($notes); $i++)
{
	if($notes[$i]->getActive() == "0")
		$active = "Cachée";
	elseif($notes[$i]->getActive() == "1")
		$active = "Affichée";

	require("views/note.phtml");
}
?>