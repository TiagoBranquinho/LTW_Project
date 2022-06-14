<?php
    declare(strict_types = 1);
    session_start();

    include_once('database/connection.db.php');
    include_once('database/restaurant.class.php');

    $db = getDatabaseConnection();

    $restaurant = Restaurant::getRestaurant($db, (int) $_POST['id']);
    $oldRestaurantName = $restaurant->getName();
    if(isset($_POST['restaurantName'])) {
        $restaurant->name = $_POST['restaurantName'];
    }
    if(isset($_POST['restaurantCategory'])) {
        $restaurant->category = $_POST['restaurantCategory'];
    }

    if(isset($_POST['restaurantAddress'])) {
        $restaurant->address = $_POST['restaurantAddress'];
    }

    if (isset($_POST['restaurantImage'])) {
        $image = Image::getImage($db,$restaurant->imageID);
        unlink($image->getPath());
        Image::replaceObjectImage($db,'restaurantImage',$image->getId(),$restaurant->getName());
        Restaurant::editRestaurant($db,$restaurant,$oldRestaurantName,$restaurant->imageID);
    } else {
        Restaurant::editRestaurant($db,$restaurant,$oldRestaurantName,-1);
    }

    header('Location: restaurant.php?id='.$restaurant->restaurantID.'&filter=All');
?>