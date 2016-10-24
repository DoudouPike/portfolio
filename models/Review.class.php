<?php

class Review
{
	//Propriétés
	private $id;
	private $title;
	private $content;
	private $date;
	private $id_project;

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
	public function getFormatedDate()
	{
		$date = new DateTime($this->date);
		return $date->format('d/m/Y');
	}
	public function getProject()
	{
		if(!$this->project)
		{
			$manager = new ProjectManager($this->db);
			$this->project = $manager->find($this->id_project);
		}
		return $this->project;
	}

	//Set
	public function setTitle($title)
	{
		if (empty($title))
			throw new Exception("Titre vide");
		elseif (strlen($title) < 4)
			throw new Exception("Titre trop court");
		elseif (strlen($title) > 63)
			throw new Exception("Titre trop long");
		else
		{
			$this->title = $title;
		}
	}
	public function setContent($content)
	{
		if(empty($content))
			throw new Exception("Contenu vide");
		elseif(strlen($content) < 4)
			throw new Exception("Contenu trop court");
		elseif(strlen($content) > 4095)
			throw new Exception("Contenu trop long");
		else
		{
			$this->content = $content;
		}
	}
	public function setProject(Project $project)
	{
		$this->project = $project;
		$this->id_project = $project->getId();
	}
}
?>