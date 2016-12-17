<?php
if(isset($_POST['action']))
{
	if($_POST['action'] == "contact")
	{
		$boundary = "-----=".md5(rand());
		try
		{
		//M'envoyer l'email
			$mind_email = "contact@doudoupike.fr";
			$user_pseudo = htmlentities($_POST['pseudo']);
			$user_email = htmlentities($_POST['email']);
			$user_object = htmlentities($_POST['object']);
			$user_content = htmlentities($_POST['message']);

			if(empty($user_pseudo) || empty($user_email) || empty($user_object) || empty($user_content))
				throw new Exception("Merci de compléter tous les champs");

			$mind_return = "\n";

			//Mind header
			$mind_header = 'From: "'.$user_pseudo.'" <'.$user_email.'>'.$mind_return;
			$mind_header .= 'Reply-to: "DoudouPike" <'.$mind_email.'>'.$mind_return;
			$mind_header .= "MIME-Version: 1.0".$mind_return;
			$mind_header .= "X-Priority: 2".$mind_return;
			$mind_header .= "Content-Type: multipart/alternative;".$mind_return." boundary=\"$boundary\"".$mind_return;

			//mind message
			$mind_message = $mind_return."--".$boundary.$mind_return;
			$mind_message .= "Content-Type: text/html; charset=\"UTF-8\"".$mind_return;
			$mind_message .= "Content-Transfer-Encoding: 8bits".$mind_return;
			$mind_message .= $mind_return.$user_content.$mind_return;
			$mind_message.= $mind_return."--".$boundary."--".$mind_return;

			//mind mail
			$mind_mail = mail($mind_email, $user_object, $mind_message, $mind_header);
			if(!$mind_mail)
			{
				throw new Exception("Erreur lors de l'envoi du message. Contactez moi via contact@doudoupike.fr");
			}



			
		//Envoyer l'email à l'utilisateur
			if(!preg_match("#^[a-z0-9._-]+@(hotmail|live|msn).[a-z]{2,4}$#", $user_email))
			{
				$user_return = "\r\n";
			}
			else
			{
				$user_return = "\n";
			}

			$mind_object = "[DoudouPike] - Confirmation d'envoi";
			$mind_content = "<html><head></head><body><p>Votre message a bien été envoyé ".$user_pseudo."!</p><p>Votre message : ".$user_content."</p><p>Vous pouvez me contacter directement par mail <a href=\"contact@doudoupike.fr\">contact@doudoupike.fr</a>. '.'</p></body></html>";

			//user header
			$user_header = 'From: "DoudouPike" <contact@doudoupike.fr>'.$user_return;
			$user_header .= 'Reply-to: "'.$user_pseudo.'" <'.$user_email.'>'.$user_return;
			$user_header .= "MIME-Version: 1.0".$user_return;
			$user_header .= "X-Priority: 2".$user_return;
			$user_header .= "Content-Type: multipart/alternative;".$user_return." boundary=\"$boundary\"".$user_return;

			//user message
			$user_message = $user_return."--".$boundary.$user_return;
			$user_message .= "Content-Type: text/html; charset=\"UTF-8\"".$user_return;
			$user_message .= "Content-Transfer-Encoding: 8bits".$user_return;
			$user_message .= $user_return.$mind_content.$user_return;
			$user_message.= $user_return."--".$boundary."--".$user_return;

			$user_mail = mail($user_email, $mind_object, $user_message, $user_header);

			if($user_mail)
				$_SESSION['successMail'] = "";
			
			header('Location: index.php?page=contact');
			exit;
		}
		catch(Exception $e)
		{
			$error = $e->getMessage();
		}
		
			
	}
}
?>