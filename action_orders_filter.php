<?php
    declare(strict_types = 1);
    session_start();

    header('Location: my_orders.php?filter=' . $_POST['orderState']);
?>