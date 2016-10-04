<?php

class Comment
{
	//Propriétés
	private $id;
	private $note;
	private $title;
	private $content;
	private $id_product;
	private $id_user;

	private $db;
	private $user;
	private $product;
	private $gRate;
	
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
	public function getNote()
	{
		return $this->note;
	}
	public function getTitle()
	{
		return $this->title;
	}
	public function getContent()
	{
		return $this->content;
	}
	public function getProduct()
	{
		if (!$this->product)
		{
			$productManager = new ProductManager($this->db);
			$this->product = $productManager->findById($this->id_product);
		}
		return $this->product;
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
	public function setNote($note)
	{
		if(empty($note) || strlen($note) != 1 || $note < 1 || $note > 5)
			throw new Exception("La note doit être comprise entre 1 et 5");
		else
			$this->note = $note;
	
	}
	public function setTitle($title)
	{
		if(empty($title) || strlen($title) < 1 || strlen($title) > 31)
			throw new Exception("Le titre doit être compris entre 2 et 31 caractères");
		else
			$this->title = $title;
	}
	public function setContent($content)
	{
		if(empty($content) || strlen($content) < 1 || strlen($content) > 1023)
			throw new Exception("Le contenu doit être compris entre 2 et 1023 caractères");
		else
			$this->content = $content;
	}
	public function setProduct(Product $product)
	{
		$this->id_product = $product->getId();
		$this->product = $product;
	}
	public function setUser(User $user)
	{
		$this->id_user = $user->getId();
		$this->user = $user;
	}
}
?>