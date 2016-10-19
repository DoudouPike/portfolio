<?php

class Prod
{
	//Propriétés
	private $id;
	private $title;
	private $description;
	private $image;
	private $url;
	private $client;
	private $date;

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
	public function getTitle()
	{
		return $this->title;
	}
	public function getDescription()
	{
		return $this->description;
	}
	public function getImage()
	{
		return $this->image;
	}
	public function getUrl()
	{
		return $this->url;
	}
	public function getClient()
	{
		return $this->client;
	}
	public function getDate()
	{
		return $this->date;
	}

	//Set
	public function setTitle($title)
	{
		if (empty($title))
			throw new Exception("Title vide");
		elseif (strlen($title) < 4)
			throw new Exception("Title trop court");
		elseif (strlen($title) > 63)
			throw new Exception("Title trop long");
		else
			$this->title = $title;
	}
	public function setDescription($description)
	{
		if(empty($description))
			throw new Exception("Description vide");
		elseif(strlen($description) < 4)
			throw new Exception("Description trop court");
		elseif(strlen($description) > 4095)
			throw new Exception("Description trop long");
		else
			$this->description = $description;
	}
	public function setClient($client)
	{
		if(empty($client))
			throw new Exception("Client invalide");
		elseif(strlen($client) > 63)
			throw new Exception("Client trop long");
		else
			$this->client = $client;
	}
	public function setImage($image)
	{		
		$this->image = $image;
	}
	public function setUrl($url)
	{
		if(empty($url) && !filter_var($url, FILTER_VALIDATE_URL))
			throw new Exception("Url invalide");
		else
			$this->url = $url;
	}
	public function setDate($date)
	{
		$tab = explode("-", $date);
		if(!checkdate($tab[1], $tab[2], $tab[0]))
			throw new Exception("Date invalide");
		else			
			$this->date = $date;
	}
}
?>