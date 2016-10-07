<?php

class ReviewManager
{
	private $db;

	public function __construct($db)
	{
		$this->db = $db;
	}

	/*
	public function search($search)
	{
		$list = [];
		$search = mysqli_real_escape_string($this->db, $search);
		$query = "SELECT * FROM reviews WHERE name LIKE '%".$search."%' OR description LIKE '%".$search."%' OR excerpt LIKE '%".$search."%'";
		$res = mysqli_query($this->db, $query);
		while($reviews = mysqli_fetch_object($res, "Review", [$this->db]))
		{
			$list[] = $reviews;
		}
		return $list;	
	}
	*/
	public function findById($id)
	{
		$id = intval($id);
		$query = "SELECT * FROM reviews WHERE id='".$id."'";
		$res = mysqli_query($this->db, $query);
		$review = mysqli_fetch_object($res, "Review", [$this->db]);
		return $review;
	}
	public function find($id)
	{
		return $this->findById($id);
	}
	public function findByProject(Project $project)
	{
		$list = [];
		$query = "SELECT * FROM reviews WHERE id_project='".$project->getId()."' ORDER BY date DESC";
		$res = mysqli_query($this->db, $query);
		while ($review = mysqli_fetch_object($res, "Review", [$this->db]))
			$list[] = $review;
		return $list;
	}
	public function save(Review $review)
	{
		$title = mysqli_real_escape_string($this->db, $review->getTitle());
		$content = mysqli_real_escape_string($this->db, $review->getContent());
		$id = $review -> getId();
		if(isset($_SESSION["id"]) && $_SESSION["admin"] === "1")
		{
			$query = "UPDATE reviews SET title='".$title."', content='".$content."' WHERE id=".$id."";
			$res = mysqli_query($this->db, $query);
			if (!$res)
				throw new Exception("Erreur interne > ".mysqli_error($this->db));
			return $this->findById($id);
		}
	}

	public function remove(Review $review)
	{
		$id = $review->getId();
		if(isset($_SESSION["id"]) && $_SESSION["admin"] === "1")
		{
			$query = "DELETE FROM reviews WHERE id='".$id."'";
			$res = mysqli_query($this->db, $query);
			if(!$res)
				throw new Exception("Erreur interne > ".mysqli_error($this->db));
		}
	}
	public function create(Project $project, $title, $content)
	{
		$review = new Review($this->db);
		$review->setTitle($title);
		$review->setContent($content);
		
		$title = mysqli_real_escape_string($this->db, $review->getTitle());
		$content = mysqli_real_escape_string($this->db, $review->getDescription());
		$id_project = $comment->getProject()->getId();
		
		if(isset($_SESSION["id"]) && $_SESSION["admin"] === "1")
		{
			$query = "INSERT INTO reviews (id_project, title, content) VALUES(".$id_project.",'".$title."', '".$content."')";
			$res = mysqli_query($this->db, $query);
			if (!$res)
				throw new Exception("Erreur interne > ".mysqli_error($this->db));
			$id = mysqli_insert_id($this->db);
			return $this -> findById($id);
		}
	}
}
?>