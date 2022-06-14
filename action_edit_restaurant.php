<?php
    declare(strict_types = 1);
    session_start();

    include_once('database/connection.db.php');
    include_once('database/restaurant.class.php');
    include_once ('database/image.class.php');

    $db = getDatabaseConnection();

    $restaurant = Restaurant::getRestaurant($db, (int) $_POST['id']);
    $image = Image::getImage($db, $restaurant->imageID);

    $oldRestaurantName = $restaurant->getName();
    if(!empty($_POST['restaurantName'])) {
        $restaurant->name = $_POST['restaurantName'];
        $almostImagePath = "img/restaurants/".$oldRestaurantName."/".$restaurant->getName().".png";
        $oldFolderName = "img/restaurants/".$oldRestaurantName;
        $newFolderName = "img/restaurants/".$restaurant->getName();

        if(rename($image->getPath(),$almostImagePath) && rename($oldFolderName,$newFolderName)) {
            $newImagePath = "img/restaurants/".$restaurant->getName()."/".$restaurant->getName().".png";
            $insertFilenameStmt = $db->prepare('UPDATE Image SET path = ? WHERE imageID = ?');
            $insertFilenameStmt->execute(array($newImagePath, $image->getId()));
        }
    }
    if(!empty($_POST['restaurantCategory'])) {
        $restaurant->category = $_POST['restaurantCategory'];
    }

    if(!empty($_POST['restaurantAddress'])) {
        $restaurant->address = $_POST['restaurantAddress'];
    }

    if ($_FILES['restaurantImage']) {
        Image::replaceObjectImage('restaurantImage', $restaurant->getName());
    }

    header('Location: restaurant.php?id='.$restaurant->restaurantID.'&filter=All');
    Restaurant::editRestaurant($db, $restaurant, $restaurant->imageID);
?>