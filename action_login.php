<?php
  declare(strict_types = 1);
  session_start();

  include_once('database/connection.db.php');
  include_once('database/user.class.php');

  $db = getDatabaseConnection();

  $user = User::getUserWithPassword($db, $_POST['username'], $_POST['password']);

  if ($user) {
    $_SESSION['username'] = $user->username;
    header('Location: user.php');
  }
  else{
    header('Location: ' . $_SERVER['HTTP_REFERER']);
  }
?>