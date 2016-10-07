<?php

class User
{
	//Propriétés
	private $id;
	private $title;
	private $content;
	private $image;
	private $url;
	private $date;
	private $last_date;

	private $db;
	private $review;
	private $comment;


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
	public function getImage()
	{
		return $this->image;
	}
	public function getUrl()
	{
		return $this->url;
	}
	public function getDate()
	{
		return $this->date;
	}
	public function getLastDate()
	{
		return $this->last_date;
	}
	public function getReview()
	{
		if(!$this->review)
		{
			$manager = new ReviewManager($this->db);
			$this->review = $manager->findByProject($this);
		}
		return $this->review;
	}
	public function getComment()
	{
		if(!$this->comment)
		{
			$manager = new CommentManager($this->db);
			$this->comment = $manager->findByProject($this);
		}
		return $this->comment;
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
	public function setImage($image)
	{
		if(!empty($image) && !filter_var($image, FILTER_VALIDATE_URL))
			throw new Exception("Url image invalide");
		else
			$this->image = $image;
	}
	public function setUrl($url)
	{
		if(!empty($url) && !filter_var($url, FILTER_VALIDATE_URL))
			throw new Exception("Url invalide");
		else
			$this->url = $url;
	}
	public function setDate($date)
	{
		// /!\
		$this->date = $date;
	}
}
?>