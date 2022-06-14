<?php 
    session_start();
    include_once('database/order.class.php');
    include_once('database/connection.db.php');
    if(!isset($_SESSION['username'])){
        header('Location: login.php');
    }
    else{
    $counter = $_POST['resquestsNr'];
    $start = 1;
    $valid = 0;
    $id = getCurrID(getDatabaseConnection(), "orderID", "Orders");

    while($counter > 0){
        if(isset($_POST['element' . $start]) ){
            if($_POST['quantity' . $start] > 0){
                $valid = 1;
                $order = new Order($id,"Received", $_POST['restaurantID'], $_POST['element' . $start], $_POST['quantity' . $start], $_SESSION['username']);
                Order::registerOrder(getDatabaseConnection(), $order);
            }
            $counter--;
        }
        $start++;
    };
    if(!$valid)
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    else
        header('Location: my_orders.php?filter=All&fav=off');
    }
    ?>

