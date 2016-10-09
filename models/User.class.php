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
	public function getHash()
	{
		return $this->password;
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
	public function setEmail($email)
	{
		if (empty($email) || strlen($email) > 63 || !filter_var($email, FILTER_VALIDATE_EMAIL))
			throw new Exception("Adresse email invalide");
		else
			$this->email = $email;
	}
	public function initPassword($pwd, $pwd2)
	{
		if(empty($pwd))
			throw new Exception("Mot de passe vide");
		elseif(strlen($pwd) < 6)
			throw new Exception("Mot de passe trop court");
		elseif(strlen($pwd) > 255)
			throw new Exception("Mot de passe trop long");
		elseif($pwd != $pwd2)
			throw new Exception("Les mots de passe ne correspondent pas");
		else
			$this->password = password_hash($pwd, PASSWORD_BCRYPT);
	}
	public function verifPassword($password)
	{
		return password_verify($password, $this->password);
	}
	public function setAdmin($admin)
	{
		$values = ["0", "1"];
		if(!in_array($admin, $values))
			throw new Exception("Valeur de Admin invalide");
		else
			$this->admin = $admin;
	}
}

?>