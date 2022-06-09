<?php
    declare(strict_types = 1);
    session_start();

    header('Location: restaurants.php?filter=' . $_POST["restaurantCategory"]);
?>