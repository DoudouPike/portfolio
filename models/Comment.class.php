<?php

class Comment
{
	//Propriétés
	private $id;
	private $id_project;
	private $id_user;
	private $content;
	private $date;

	private $db;
	private $user;
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
	public function getUser()
	{
		if (!$this->user)
		{
			$userManager = new UserManager($this->db);
			$this->user = $userManager->findById($this->id_user);
		}
		return $this->user;
	}

		//Set
	public function setContent($content)
	{
		if(empty($content) || strlen($content) < 1 || strlen($content) > 1023)
			throw new Exception("Le contenu doit être compris entre 2 et 1023 caractères");
		else
			$this->content = $content;
	}
	public function setProject(Project $project)
	{
		$this->id_project = $project->getId();
		$this->project = $project;
	}
	public function setUser(User $user)
	{
		$this->id_user = $user->getId();
		$this->user = $user;
	}
}
?>