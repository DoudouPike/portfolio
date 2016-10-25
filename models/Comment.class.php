<?php

class Comment
{
	//Propriétés
	private $id;
	private $content;
	private $date;
	private $id_project;
	private $id_author;

	private $db;
	private $project;
	private $user;
	
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
	public function getDate()
	{
		return $this->date;
	}
	public function getProject()
	{
		if (!$this->project)
		{
			$projectManager = new ProjectManager($this->db);
			$this->project = $projectManager->findById($this->id_project);
		}
		return $this->project;
	}
	public function getAuthor()
	{
		if (!$this->user)
		{
			$userManager = new UserManager($this->db);
			$this->user = $userManager->findById($this->id_author);
		}
		return $this->user;
	}

		//Set
	public function setContent($content)
	{
		if(empty($content) || strlen($content) < 1 || strlen($content) > 512)
			throw new Exception("Le contenu doit être compris entre 2 et 512 caractères");
		else
			$this->content = $content;
	}
	public function setProject(Project $project)
	{
		$this->id_project = $project->getId();
		$this->project = $project;
	}
	public function setAuthor(User $user)
	{
		$this->id_user = $user->getId();
		$this->user = $user;
	}
}
?>