<?php
    declare(strict_types = 1);
    session_start();

    include_once('database/connection.db.php');
    include_once('database/user.class.php');

    if(empty($_POST['username']) || empty($_POST['password']) || empty($_POST['email']) || empty($_POST['address']) ||
       empty($_POST['phoneNumber']) || !(isset($_POST['restOwner']) || isset($_POST['costumer'])))
    {
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }

    $db = getDatabaseConnection();
    $created = User::registerUser($db, $_POST['username'], $_POST['password'], $_POST['email'], $_POST['address'], $_POST['phoneNumber'], $_POST['restOwner']?true:false, $_POST['costumer']?true:false);

    if (!$created) {
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    } else {
        header('Location: login.php');
    }
?>