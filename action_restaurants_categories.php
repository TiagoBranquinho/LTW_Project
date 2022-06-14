<?php
    declare(strict_types = 1);
    session_start();
    if(!isset($_SESSION['username']) && $_POST["fav"] === "on"){
        header('Location: login.php');
    }
    header('Location: restaurants.php?filter=' . $_POST["restaurantCategory"] . '&fav=' . $_POST['fav']);
?>