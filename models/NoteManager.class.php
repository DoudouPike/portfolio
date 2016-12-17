<?php
class NoteManager
{
	private $db;
	public function __construct($db)
	{
		$this->db = $db;
	}
	public function findById($id)
	{
		$id = intval($id);
		$query = "SELECT * FROM notes WHERE id='".$id."'";
		$res = mysqli_query($this->db, $query);
		$note = mysqli_fetch_object($res, "Note", [$this->db]);
		return $note;
	}
	public function findAll()
	{
		$list = [];
		$query = "SELECT * FROM notes";
		$res = mysqli_query($this->db, $query);
		while($notes = mysqli_fetch_object($res, "Note", [$this->db]))
		{
			$list[] = $notes;
		}
		return $list;	
	}
	public function findActive()
	{
		$list = [];
		$query = 'SELECT * FROM notes WHERE active="1" ORDER BY id DESC';
		$res = mysqli_query($this->db, $query);
		while($notes = mysqli_fetch_object($res, "Note", [$this->db]))
		{
			$list[] = $notes;
		}
		return $list;	
	}
	public function remove(Note $note)
	{
		$id = $note->getId();
		if(isset($_SESSION["admin"]))
		{
			$query = "DELETE FROM notes WHERE id='".$id."'";
			$res = mysqli_query($this->db, $query);
			if (!$res)
				throw new Exception("Erreur interne > ".mysqli_error($this->db));
		}
	}
	public function save(Note $note)
	{
		$content = mysqli_real_escape_string($this->db, $note->getContent());
		$active = mysqli_real_escape_string($this->db, $note->getActive());
		$id = $note -> getId();
		if(isset($_SESSION["id"], $_SESSION["admin"]))
		{
			$query = "UPDATE notes SET content='".$content."', active='".$active."' WHERE id=".$id."";
			$res = mysqli_query($this->db, $query);
			if (!$res)
				throw new Exception("Erreur interne > ".mysqli_error($this->db));
			return $this->findById($id);
		}
	}
	public function create($content, $active)
	{
		$note = new Note($this->db);
		$note->setContent($content);
		$note->setActive($active);

		$content = mysqli_real_escape_string($this->db, $note->getContent());
		$active = intval($note->getActive());

		if(isset($_SESSION["admin"]))
		{
			$query = "INSERT INTO notes (content, active) VALUES('".$content."', '".$active."')";
			$res = mysqli_query($this->db, $query);
			if (!$res)
				throw new Exception("Erreur interne > ".mysqli_error($this->db));
			$id = mysqli_insert_id($this->db);
			return $this->findById($id);
		}
	}
}
?>