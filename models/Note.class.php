<?php

class Note
{
	//Propriétés
	private $id;
	private $content;
	private $active;

	private $db;
	
	public function __construct($db)
	{
		$this->db = $db;
	}

	//Méthodes
		//Get
	public function getId()
	{
		return $this->id;
	}
	public function getContent()
	{
		return $this->content;
	}
	public function getActive()
	{
		return $this->active;
	}

		//Set
	public function setContent($content)
	{
		if(empty($content) || strlen($content) > 512)
			throw new Exception("Le contenu doit faire moins de 512 caractères");
		else
			$this->content = $content;
	}
	public function setActive($active)
	{
		$values = ["0", "1"];
		if(!in_array($active, $values))
			throw new Exception("Valeur de Active invalide");
		else
			$this->active = $active;
	}
}
?>