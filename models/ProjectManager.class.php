<?php

class ProjectManager
{
	private $db;

	public function __construct($db)
	{
		$this->db = $db;
	}

	public function findAll()
	{
		$list = [];
		$query = "SELECT * FROM projects";
		$res = mysqli_query($this->db, $query);
		while($projects = mysqli_fetch_object($res, "Project", [$this->db]))
		{
			$list[] = $projects;
		}
		return $list;	
	}
	public function findExample()
	{
		$list = [];
		$query = "SELECT * FROM projects LIMIT 3";
		$res = mysqli_query($this->db, $query);
		while($projects = mysqli_fetch_object($res, "Project", [$this->db]))
		{
			$list[] = $projects;
		}
		return $list;
	}
	/*
	public function search($search)
	{
		$list = [];
		$search = mysqli_real_escape_string($this->db, $search);
		$query = "SELECT * FROM projects WHERE name LIKE '%".$search."%' OR description LIKE '%".$search."%' OR excerpt LIKE '%".$search."%'";
		$res = mysqli_query($this->db, $query);
		while($projects = mysqli_fetch_object($res, "Project", [$this->db]))
		{
			$list[] = $projects;
		}
		return $list;	
	}
	*/
	public function findById($id)
	{
		$id = intval($id);
		$query = "SELECT * FROM projects WHERE id='".$id."'";
		$res = mysqli_query($this->db, $query);
		$project = mysqli_fetch_object($res, "Project", [$this->db]);
		return $project;
	}
	public function find($id)
	{
		return $this->findById($id);
	}
	public function save(Project $project)
	{
		$title = mysqli_real_escape_string($this->db, $project->getTitle());
		$content = mysqli_real_escape_string($this->db, $project->getContent());
		$abstract = mysqli_real_escape_string($this->db, $project->getAbstract());
		$image = mysqli_real_escape_string($this->db, $project->getImage());
		$url = mysqli_real_escape_string($this->db, $project->getUrl());
		$date = mysqli_real_escape_string($this->db, $project->getDate());
		$id = $project -> getId();
		if(isset($_SESSION["id"]) && $_SESSION["admin"] === "1")
		{
			$query = "UPDATE projects SET title='".$title."', content='".$content."', abstract='".$abstract."', image='".$image."', url='".$url."', date='".$date."' WHERE id=".$id."";
			$res = mysqli_query($this->db, $query);
			if (!$res)
				throw new Exception("Erreur interne > ".mysqli_error($this->db));
			return $this->findById($id);
		}
	}

	public function remove(Project $project)
	{
		$id = $project->getId();
		if(isset($_SESSION["id"]) && $_SESSION["admin"] === "1")
		{
			$query = "DELETE FROM projects WHERE id='".$id."'";
			$res = mysqli_query($this->db, $query);
			if (!$res)
				throw new Exception("Erreur interne > ".mysqli_error($this->db));
		}
	}


	public function create($title, $content, $abstract, $image, $url, $date)
	{
		$project = new Project($this->db);
		$project->setTitle($title);
		$project->setContent($content);
		$project->setAbstract($abstract);
		$project->setImage($image);
		$project->setUrl($url);
		$project->setDate($date);
		
		$title = mysqli_real_escape_string($this->db, $project->getTitle());
		$content = mysqli_real_escape_string($this->db, $project->getContent());
		$abstract = mysqli_real_escape_string($this->db, $project->getAbstract());
		$image = mysqli_real_escape_string($this->db, $project->getImage());
		$url = mysqli_real_escape_string($this->db, $project->getUrl());
		$date = mysqli_real_escape_string($this->db, $project->getDate());
		
		if(isset($_SESSION["admin"]))
		{
			$query = "INSERT INTO projects (title, content, abstract, image, url, date) VALUES('".$title."', '".$content."', '".$abstract."','".$image."', '".$url."', '".$date."')";
			$res = mysqli_query($this->db, $query);
			if (!$res)
				throw new Exception("Erreur interne > ".mysqli_error($this->db));
			$id = mysqli_insert_id($this->db);
			return $this -> findById($id);
		}
	}
}
?>