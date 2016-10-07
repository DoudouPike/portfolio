<?php
class UserManager
{
	private $db;
	public function __construct($db)
	{
		$this->db = $db;
	}

	public function findById($id)
	{
		$id = intval($id);
		$query = "SELECT * FROM users WHERE id='".$id."'";
		$res = mysqli_query($this->db, $query);
		$user = mysqli_fetch_object($res, "User", [$this->db]);
		return $user;
	}
	public function findByLogin($login)
	{
		$login = mysqli_real_escape_string($this->db, $login);
		$query = "SELECT * FROM users WHERE login='".$login."'";
		$res = mysqli_query($this->db, $query);
		$user = mysqli_fetch_object($res, "User", [$this->db]);
		return $user;
	}
	public function find($id)
	{
		return $this -> findById($id);
	}
	public function save(User $user)
	{
		$password = mysqli_real_escape_string($this->db, $user -> getPassword());
		$email = mysqli_real_escape_string($this->db, $user -> getEmail());
		$admin = mysqli_real_escape_string($this->db, $user -> getAdmin());
		$id_user = $user->getId();

		if((isset($_SESSION["id"]) && $id_user === $_SESSION["id"]) || (isset($_SESSION["admin"]) && $_SESSION["admin"] === "1"))
		{
			$query = "UPDATE users SET password='".$password."', email='".$email."', admin='".$admin."' WHERE id='".$id_user."'";
			$res = mysqli_query($this->db, $query);
			if (!$res)
				throw new Exception("Erreur interne > ".mysqli_error($this->db));
			return $this->findById($id);

		}
	}

	public function remove(User $user)
	{
		$id_user = $user->getId();
		if((isset($_SESSION["id"]) && $id_user === $_SESSION["id"]) || (isset($_SESSION["admin"]) && $_SESSION["admin"] === "1"))
		{
			$query = "DELETE FROM users WHERE id='".$id_user."'";

			$res = mysqli_query($this->db, $query);
			if (!$res)
				throw new Exception("Erreur interne > ".mysqli_error($this->db));

		}
	}

	public function create($login, $password, $email)
	{
		$user = new User($this -> db);
		$user -> setLogin($login);
		$user -> setPassword($password);
		$user -> setEmail($email);

		$login = mysqli_real_escape_string($this->db, $user -> getLogin());
		$password = $user -> getPassword();
		$email = mysqli_real_escape_string($this->db, $user -> getEmail());

		$query = "INSERT INTO users (login, password, email) VALUES('".$login."', '".$password."', '".$email."')";
		$res = mysqli_query($this->db, $query);
		if (!$res)
				throw new Exception("Erreur interne > ".mysqli_error($this->db));
		$id = mysqli_insert_id($this->db);
		return $this->findById($id);
	}
}
?>