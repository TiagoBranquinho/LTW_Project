<?php
  declare(strict_types = 1);
  session_start();

  include_once('database/connection.db.php');
  include_once('database/user.class.php');

  $db = getDatabaseConnection();

  $user = User::getUser($db, $_SESSION['username']);
  $user->email = $_POST['email'];
  $user->address = $_POST['address'];
  $user->phoneNumber = $_POST['tel'];

  User::editUser($db, $user);

  header('Location: user.php');
?>