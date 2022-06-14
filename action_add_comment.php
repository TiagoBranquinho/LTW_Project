<?php
  declare(strict_types = 1);
  session_start();
  include_once('database/connection.db.php');
  include_once('database/comment.class.php');
  $db = getDatabaseConnection();

  if (isset($_SESSION['username'])){
    $comment = new Comment(0, $_SESSION['reviewID'], $_SESSION['username'], $_POST['comment']);
    Comment::addComment($db, $comment);
  }
  
  header('Location: ' . $_SERVER['HTTP_REFERER']);

?>