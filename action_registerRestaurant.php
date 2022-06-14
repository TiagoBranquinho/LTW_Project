<?php
    declare(strict_types=1);
    session_start();
    include_once('database/connection.db.php');
    include_once('database/restaurantOwner.class.php');
    include_once('database/restaurant.class.php');

    if (empty($_POST['restaurantName']) || empty($_POST['restaurantCategory']) ||
        empty($_POST['restaurantAddress'])) {
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }

    $db = getDatabaseConnection();

    $restaurant = new Restaurant($_POST['restaurantName'], $_POST['restaurantCategory'], $_POST['restaurantAddress']);

    $created = Restaurant::registerRestaurant($db, $restaurant, $_SESSION['username']);

    if (!$created) {
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    } else {
        header('Location: my_restaurants.php');
    }

?>
