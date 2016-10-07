<?php

class User
{
	//Propriétés
	private $id;
	private $title;
	private $content;
	private $date;

	private $db;
	private $project;


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
	public function getTitle()
	{
		return $this->title;
	}
	public function getContent()
	{
		return $this->content;
	}
	public function getDate()
	{
		return $this->date;
	}
	public function getProject()
	{
		if(!$this->project)
		{
			$manager = new ProjectManager($this->db);
			$this->project = $manager->find($this);
		}
		return $this->project;
	}

	//Set
	public function setTitle($title)
	{
		if (empty($title))
			throw new Exception("Title vide");
		else if (strlen($title) < 4)
			throw new Exception("Title trop court");
		else if (strlen($title) > 63)
			throw new Exception("Title trop long");
		else
		{
			$this->title = $title;
		}
	}
	public function setContent($content)
	{
		if(empty($content))
			throw new Exception("Contenu vide");
		else if(strlen($content) < 4)
			throw new Exception("Contenu trop court");
		else if(strlen($content) > 4095)
			throw new Exception("Contenu trop long");
		else
		{
			$this->content = $content;
		}
	}
}
?>