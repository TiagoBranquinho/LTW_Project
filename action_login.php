<?php
  declare(strict_types = 1);
  session_start();

  include_once('database/connection.db.php');
  include_once('database/user.class.php');
  include_once ('database/restaurantOwner.class.php');

  $db = getDatabaseConnection();

  $user = User::getUserWithPassword($db, $_POST['username'], $_POST['password']);

  if ($user) {
    $_SESSION['username'] = $user->username;
      $ro = RestaurantOwner::getRO($_POST['username']);
      $customer = User::getCustomer($_POST['username']);
      if($ro && $customer) {
          $_SESSION['restaurantOwner'] = true;
          $_SESSION['customer'] = true;
      } else if($ro) {
          $_SESSION['restaurantOwner'] = true;
      } else if($customer) {
          $_SESSION['customer'] = true;
      }
    header('Location: user.php');
  }
  else{
    header('Location: ' . $_SERVER['HTTP_REFERER']);
  }
?>