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
	public function findAll()
	{
		$list = [];
		$query = "SELECT * FROM users";
		$res = mysqli_query($this->db, $query);
		while($users = mysqli_fetch_object($res, "User", [$this->db]))
		{
			$list[] = $users;
		}
		return $list;	
	}
	public function findByLogin($login)
	{
		$login = mysqli_real_escape_string($this->db, $login);
		$query = "SELECT * FROM users WHERE login='".$login."' OR email='".$login."'";
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
		$password = mysqli_real_escape_string($this->db, $user -> getHash());
		$email = mysqli_real_escape_string($this->db, $user -> getEmail());
		$admin = intval($user -> getAdmin());
		$id_user = $user->getId();

		if(isset($_SESSION["id"]) && ($id_user === $_SESSION["id"] || isset($_SESSION['admin'])))
		{
			$query = "UPDATE users SET email='".$email."', password='".$password."', admin='".$admin."' WHERE id='".$id_user."'";
			$res = mysqli_query($this->db, $query);
			if(!$res)
				throw new Exception("Erreur interne > ".mysqli_error($this->db));
			return $this->findById($id_user);

		}
	}

	public function updateAdmin(User $user)
	{
		$admin = intval($user->getAdmin());
		$id_user = $user->getId();
		if(isset($_SESSION['admin']))
		{
			$query = "UPDATE users SET admin='".$admin."' WHERE id='".$id_user."'";
			$res = mysqli_query($this->db, $query);
			if(!$res)
				throw new Exception("Erreur interne > ".mysqli_error($this->db));
			return $this->findById($id_user);
		}

	}

	public function remove(User $user)
	{
		$id_user = $user->getId();
		if(((isset($_SESSION["id"]) && $id_user === $_SESSION["id"])) || isset($_SESSION["admin"]))
		{
			$query = "DELETE FROM users WHERE id='".$id_user."'";

			$res = mysqli_query($this->db, $query);
			if (!$res)
				throw new Exception("Erreur interne > ".mysqli_error($this->db));

		}
	}

	public function create($login, $email, $pwd, $pwd2)
	{
		$user = new User($this->db);
		$user->setLogin($login);
		$user->setEmail($email);
		$user->initPassword($pwd, $pwd2);

		$login = mysqli_real_escape_string($this->db, $user->getLogin());
		$email = mysqli_real_escape_string($this->db, $user->getEmail());
		$hash = mysqli_real_escape_string($this->db, $user -> getHash());

		$query = "INSERT INTO users (login, email, password) VALUES('".$login."', '".$email."', '".$hash."')";
		$res = mysqli_query($this->db, $query);

		if (!$res)
		{
			if(mysqli_errno($this->db) === 1062)
				throw new Exception("Pseudo ou Email déjà utilisé");
			else
				throw new Exception("Contactez moi, code d'erreur :".mysqli_errno($this->db));
		}

		$id = mysqli_insert_id($this->db);
		return $this->findById($id);
	}
}
?>