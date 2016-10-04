<?php
class CommentManager
{
	private $db;
	public function __construct($db)
	{
		$this->db = $db;
	}
	public function findNoteByProduct(Product $product)
	{
		$list = [];
		$query = "SELECT note FROM comments WHERE id_product='".$product->getId()."'";
		$res = mysqli_query($this->db, $query);
		while ($note = mysqli_fetch_object($res, "Comment", [$this->db]))
			$list[] = $note;
		if(!empty($list))
		{
			for($i = 0; $i < sizeof($list) ; $i++)
			{ 
				$note = $list[$i];
				$noteTab[] = $note->getNote();
			}

			$gNote_float = array_sum($noteTab) / sizeof($list);
			$gNote = round($gNote_float);

			return $gNote;
		}
	}
	public function findByProduct(Product $product)
	{
		$list = [];
		$query = "SELECT * FROM comments WHERE id_product='".$product->getId()."' ORDER BY id DESC";
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

	public function create(Product $product, User $user, $note, $title, $content)
	{
		$comment = new Comment($this->db);
		$comment->setNote($note);
		$comment->setTitle($title);
		$comment->setContent($content);
		$comment->setProduct($product);
		$comment->setUser($user);

		$note = intval($comment->getNote());
		$title = mysqli_real_escape_string($this->db, $comment->getTitle());
		$content = mysqli_real_escape_string($this->db, $comment->getContent());
		$id_product = $comment->getProduct()->getId();
		$id_user = $comment->getUser()->getId();
		$query = "INSERT INTO comments (note, title, content, id_product, id_user) VALUES('".$note."', '".$title."', '".$content."', '".$id_product."','".$id_user."')";
		$res = mysqli_query($this->db, $query);
		if (!$res)
			throw new Exception("Erreur interne > ".mysqli_error($this->db));
		$id = mysqli_insert_id($this->db);
		
		return $this->findById($id);
	}
}
?>