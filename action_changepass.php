<?php
  declare(strict_types = 1);
  session_start();

  include_once('database/connection.db.php');
  include_once('database/user.class.php');

  $db = getDatabaseConnection();
  $user = User::getUser($db, $_SESSION['username']);
  $user->changePass($db, sha1($_POST['newPass']));  
  header('Location: user.php');
?>