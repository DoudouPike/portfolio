<?php
$noteManager = new NoteManager($db);

if(isset($_GET['admin']))
{
	$tabs = $noteManager->findAll();
	for ($i=0; $i < sizeof($tabs); $i++)
	{
		if($tabs[$i]->getActive() == "0")
			$active = "Cachée";
		elseif($tabs[$i]->getActive() == "1")
			$active = "Affichée";

		require("views/note.phtml");
	}
}

else
{

	$tabs = $tabsManager->findActive();
	for ($i=0; $i < sizeof($tabs); $i++)
	{
		require("views/note.phtml");
	}
}
?>