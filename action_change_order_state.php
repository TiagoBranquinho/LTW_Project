<?php 
declare (strict_types = 1);
include_once('database/order.class.php');
include_once('database//connection.db.php');

    Order::updateOrder(getDatabaseConnection(), (int) $_POST['id'], $_POST['orderState']);
    header('Location: ' . $_SERVER['HTTP_REFERER']);
?>