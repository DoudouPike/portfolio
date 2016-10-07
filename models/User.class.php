<?php

class User
{
	//Propriétés
	private $id;
	private $login;
	private $email;
	private $pwd;
	private $admin;

	private $db;
	private $comments;


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
	public function getLogin()
	{
		return $this->login;
	}
	public function getEmail()
	{
		return $this->email;
	}
	public function getPassword()
	{
		return $this->pwd;
	}
	public function getAdmin()
	{
		return $this->admin;
	}
	public function getComment()
	{
		if (!$this->comment)
		{
			$manager = new CommentManager($this->db);
			$this->comment = $manager->findByUser($this);
		}
		return $this->comment;
	}

	//Set
	public function setLogin($login)
	{
		if (empty($login))
			throw new Exception("Login vide");
		else if (strlen($login) < 4)
			throw new Exception("Login trop court");
		else if (strlen($login) > 31)
			throw new Exception("Login trop long");
		else
		{
			$this->login = $login;
		}
	}
	public function setPassword($pwd)
	{
		if (empty($pwd))
			throw new Exception("Mot de passe vide");
		else if (strlen($pwd) < 6)
			throw new Exception("Mot de passe trop court");
		else if (strlen($pwd) > 255)
			throw new Exception("Mot de passe trop long");
		else
		{
			$hash = password_hash($pwd, PASSWORD_BCRYPT, ["cost"=>12]);
			$this->pwd = $hash;
		}
	}
	public function setEmail($email)
	{
		if (empty($email) || strlen($email) > 63 || !filter_var($email, FILTER_VALIDATE_EMAIL))
			throw new Exception("Adresse email invalide");
		else
			$this->email = $email;
	}
	public function setAdmin($admin)
	{
		if($gender < 0 || $gender > 1)
			throw new Exception("Erreur interne");
		else
			$this->admin = $admin;
	}
}

?>