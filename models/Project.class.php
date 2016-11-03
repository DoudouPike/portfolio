<?php

class Project
{
	//Propriétés
	private $id;
	private $title;
	private $content;
	private $abstract;
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
	public function getAbstract()
	{
		return $this->abstract;
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
	public function getFormatedDate()
	{
		$date = new DateTime($this->date);
		return $date->format('d/m/Y');
	}
	public function getLastDate()
	{
		$last_date = new DateTime($this->last_date);
		return $last_date->format('d/m/Y à H\h');
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
	public function setAbstract($abstract)
	{
		if(empty($abstract))
			throw new Exception("Résumé vide");
		else if(strlen($abstract) < 4)
			throw new Exception("Résumé trop court");
		else if(strlen($abstract) > 1023)
			throw new Exception("Résumé trop long");
		else
		{
			$this->abstract = $abstract;
		}
	}
	public function setImage($image)
	{
		if(empty($image))
			$image = "default.png";
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
		$tab = explode("/", $date);
		if(!checkdate($tab[1], $tab[0], $tab[2]))
			throw new Exception("Date invalide");
		else			
			$date = $tab[2].'-'.$tab[1].'-'.$tab[0];
			$this->date = $date;
	}
}
?>