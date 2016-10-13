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
	public function remove(Note $note)
	{
		$id = $note->getId();
		if (isset($_SESSION["admin"]))
		{
			$query = "DELETE FROM notes WHERE id='".$id."'";
			$res = mysqli_query($this->db, $query);
			if (!$res)
				throw new Exception("Erreur interne > ".mysqli_error($this->db));
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