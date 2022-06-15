<?php
declare(strict_types=1);
include_once('database/user.class.php');

if($_POST['isFavourite'] == 1) {
    User::removeRestaurantAsFavourite(getDatabaseConnection(),$_POST['username'], (int) $_POST['restaurantID']);
} else {
    User::setRestaurantAsFavourite(getDatabaseConnection(),$_POST['username'], (int) $_POST['restaurantID']);
}

header('Location: ' . $_SERVER['HTTP_REFERER']);

?>