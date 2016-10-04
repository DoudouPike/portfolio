<?php
if(isset($_POST["action"]))
{
	$commentManager = new CommentManager($db);
	$productManager = new ProductManager($db);
	$userManager = new UserManager($db);

	$action = $_POST['action'];
	if($action == 'create_comment')
	{
		if(isset($_POST['note'], $_POST['title'], $_POST['content'], $_POST['id_product'], $_SESSION["id"]))
		{
			try
			{
				$product = $productManager->findById($_POST['id_product']);
				if (!$product)
					throw new Exception("Le produit n'existe pas");
				$user = $userManager->findById($_SESSION['id']);
				if (!$user)
					throw new Exception("Vous n'êtes plus connecté");

				$comment = $commentManager->create($product, $user, $_POST['note'], $_POST['title'], $_POST['content']);
				if (!$comment)
					throw new Exception("Erreur interne");
				
				header('Location: index.php?page=product_single&id='.$product->getId());
				exit;
				
			}
			catch (Exception $exception)
			{
				$error = $exception->getMessage();
			}
		}
	}
	elseif($action == "remove_comment" && isset($_POST["id_comment"]) && (isset($_SESSION['id']) || isset($_SESSION["admin"])))
	{
		var_dump($_POST);
		$comment = $commentManager->findById($_POST['id_comment']);

		if($comment->getUser()->getId() === $_SESSION['id'])
		{
			try
			{
				$id_product = $comment->getProduct()->getId();
				$commentManager -> remove($comment);
				header('Location: index.php?page=product_single&id='.$id_product.'');
				exit;
			}
			catch (Exception $exception)
			{
				$error = $exception->getMessage();
			}
		}
		else
		{
			$error = "Bien essayé ! =)";
		}		
	}
}
?>