<?php
if((isset($_SESSION["user"]) && $_SESSION["user"] === $comment->getUser()->getId()) || (isset($_SESSION["admin"]) && $_SESSION["admin"] === "1"))
{
require("views/comments_admin.phtml");
}

?>