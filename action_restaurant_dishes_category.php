<?php
    declare(strict_types = 1);
    session_start();

    header('Location: restaurant.php?filter=' . $_POST["dishCategory"] . '&id=' . $_POST['id']);
?>