<?php
class CommentManager
{
	private $db;
	public function __construct($db)
	{
		$this->db = $db;
	}
	public function findByProject(Project $project)
	{
		$list = [];
		$query = "SELECT * FROM comments WHERE id_project='".$project->getId()."' ORDER BY id DESC";
		$res = mysqli_query($this->db, $query);
		while ($comment = mysqli_fetch_object($res, "Comment", [$this->db]))
			$list[] = $comment;
		return $list;
	}
	public function findByUser(User $user)
	{
		$list = [];
		$query = "SELECT * FROM comments WHERE id_user='".$user->getId()."'";
		$res = mysqli_query($this->db, $query);
		if($res)
			while ($comment = mysqli_fetch_object($res, "Comment", [$this->db]))
				$list[] = $comment;
			return $list;
	}
	public function findById($id)
	{
		$id = intval($id);
		$query = "SELECT * FROM comments WHERE id='".$id."'";
		$res = mysqli_query($this->db, $query);
		$comment = mysqli_fetch_object($res, "Comment", [$this->db]);
		return $comment;
	}
	public function find($id)
	{
		return $this->findById($id);
	}

	public function remove(Comment $comment)
	{
		$id_comment = $comment->getId();
		$id_user = $comment->getUser()->getId();
		if ((isset($_SESSION["id"]) && $id_user === $_SESSION["id"]) || (isset($_SESSION["admin"]) && $_SESSION["admin"] === "1"))
		{
			$query = "DELETE FROM comments WHERE id='".$id_comment."'";
			$res = mysqli_query($this->db, $query);
			if (!$res)
				throw new Exception("Erreur interne > ".mysqli_error($this->db));
		}
	}

	public function create(Project $project, User $user, $content, $date)
	{
		$comment = new Comment($this->db);
		$comment->setContent($content);
		$comment->setProject($project);
		$comment->setUser($user);

		$content = mysqli_real_escape_string($this->db, $comment->getContent());
		$id_project = $comment->getProject()->getId();
		$id_user = $comment->getUser()->getId();

		if(isset($_SESSION["id"]) && $_SESSION["admin"] === "1")
		{
			$query = "INSERT INTO comments (content, id_project, id_user) VALUES('".$content."', '".$id_project."','".$id_user."')";
			$res = mysqli_query($this->db, $query);
			if (!$res)
				throw new Exception("Erreur interne > ".mysqli_error($this->db));
			$id = mysqli_insert_id($this->db);
			return $this->findById($id);
		}
	}
}
?>