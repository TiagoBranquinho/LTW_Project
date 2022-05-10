<?php
  declare(strict_types = 1);
  session_start();

  include_once('database/connection.db.php');
  include_once('database/user.class.php');

  $db = getDatabaseConnection();

  $user = User::getUserWithPassword($db, $_POST['username'], $_POST['password']);

  if ($user) {
    $_SESSION['username'] = $user->username;
  }

  echo "Welcome ". $_SESSION['username'] . " to Food Center! ";
  header('Location: ' . $_SERVER['HTTP_REFERER']);
?>