<?php

class ProdManager
{
	private $db;

	public function __construct($db)
	{
		$this->db = $db;
	}

	public function findAll()
	{
		$list = [];
		$query = "SELECT * FROM prods";
		$res = mysqli_query($this->db, $query);
		while($prods = mysqli_fetch_object($res, "Prod", [$this->db]))
		{
			$list[] = $prods;
		}
		return $list;	
	}
	public function findExample()
	{
		$list = [];
		$query = "SELECT * FROM prods LIMIT 4";
		$res = mysqli_query($this->db, $query);
		while($prods = mysqli_fetch_object($res, "Prod", [$this->db]))
		{
			$list[] = $prods;
		}
		return $list;
	}
	/*
	public function search($search)
	{
		$list = [];
		$search = mysqli_real_escape_string($this->db, $search);
		$query = "SELECT * FROM prods WHERE name LIKE '%".$search."%' OR description LIKE '%".$search."%' OR excerpt LIKE '%".$search."%'";
		$res = mysqli_query($this->db, $query);
		while($prods = mysqli_fetch_object($res, "Prod", [$this->db]))
		{
			$list[] = $prods;
		}
		return $list;	
	}
	*/
	public function findById($id)
	{
		$id = intval($id);
		$query = "SELECT * FROM prods WHERE id='".$id."'";
		$res = mysqli_query($this->db, $query);
		$prod = mysqli_fetch_object($res, "Prod", [$this->db]);
		return $prod;
	}
	public function find($id)
	{
		return $this->findById($id);
	}
	public function save(Prod $prod)
	{
		$title = mysqli_real_escape_string($this->db, $prod->getTitle());
		$description = mysqli_real_escape_string($this->db, $prod->getDescription());
		$image = mysqli_real_escape_string($this->db, $prod->getImage());
		$url = mysqli_real_escape_string($this->db, $prod->getUrl());
		$client = mysqli_real_escape_string($this->db, $prod->getClient());
		$date = mysqli_real_escape_string($this->db, $prod->getDate());
		$id = $prod -> getId();
		if(isset($_SESSION["admin"]))
		{
			$query = "UPDATE prods SET title='".$title."', description='".$description."', image='".$image."', url='".$url."', client='".$client."', date='".$date."' WHERE id=".$id."";
			$res = mysqli_query($this->db, $query);
			if (!$res)
				throw new Exception("Erreur interne > ".mysqli_error($this->db));
			return $this->findById($id);
		}
	}

	public function remove(Prod $prod)
	{
		$id = $prod->getId();
		if(isset($_SESSION["admin"]))
		{
			$query = "DELETE FROM prods WHERE id='".$id."'";
			$res = mysqli_query($this->db, $query);
			if (!$res)
				throw new Exception("Erreur interne > ".mysqli_error($this->db));
		}
	}


	public function create($title, $description, $image, $url, $client, $date)
	{
		$prod = new Prod($this->db);
		$prod->setTitle($title);
		$prod->setDescription($description);
		$prod->setImage($image);
		$prod->setUrl($url);
		$prod->setClient($client);
		$prod->setDate($date);
		
		$title = mysqli_real_escape_string($this->db, $prod->getTitle());
		$description = mysqli_real_escape_string($this->db, $prod->getDescription());
		$image = mysqli_real_escape_string($this->db, $prod->getImage());
		$url = mysqli_real_escape_string($this->db, $prod->getUrl());
		$client = mysqli_real_escape_string($this->db, $prod->getClient());
		$date = mysqli_real_escape_string($this->db, $prod->getDate());
		
		if(isset($_SESSION["admin"]))
		{
			$query = "INSERT INTO prods (title, description, image, url, client, date) VALUES('".$title."', '".$description."', '".$image."', '".$url."', '".$client."', '".$date."')";
			$res = mysqli_query($this->db, $query);
			if (!$res)
				throw new Exception("Erreur interne > ".mysqli_error($this->db));
			$id = mysqli_insert_id($this->db);
			return $this -> findById($id);
		}
	}
}
?>