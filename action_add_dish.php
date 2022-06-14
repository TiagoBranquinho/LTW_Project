<?php
declare(strict_types=1);

include_once('database/connection.db.php');
include_once ('database/dish.class.php');
include_once('database/restaurantOwner.class.php');
include_once('database/restaurant.class.php');

if (empty($_POST['dishName']) || empty($_POST['dishCategory']) ||
    empty($_POST['dishPrice'])) {
    header('Location: ' . $_SERVER['HTTP_REFERER']);
}

$db = getDatabaseConnection();

$dish = new Dish($_POST['dishName'], (int) $_POST['restaurantID'], (float) $_POST['dishPrice'], $_POST['dishCategory'], (float) $_POST['dishDiscount']);

$created = Dish::addDishToRestaurant($db,$dish);

if (!$created) {
    header('Location: ' . $_SERVER['HTTP_REFERER']);
} else {
    header('Location: my_restaurants.php');
}

?>