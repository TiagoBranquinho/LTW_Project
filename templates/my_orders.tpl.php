<?php
    declare (strict_types = 1);
    include_once('database/connection.db.php');
    include_once('database/order.class.php');
    function output_my_orders_list(string $username){;?>
    <main>
    <div class="orderFilter">
        <h1>My Orders</h1>
        <h4>Filter by State:</h4>
        <form action="action_orders_filter.php" method="POST">
            <select name="orderState">
                <?php $states = Order::getOrdersStates(getDatabaseConnection());
                foreach($states as $state){
                    if($state['kind'] === $_GET['filter']){
                        echo  "<option selected value='" . $state['kind'] . "'>" . $state['kind'] . "</option>";
                    }
                    else{
                        echo  "<option value='" . $state['kind'] . "'>" . $state['kind'] . "</option>";
                    }
                };?>
            </select>
            <h4>Only Favorite Restaurants</h4>
            <input type="checkbox" name="favourite">
            <button type="submit">Filter</button>
        </form>
        <?php $orderList = Order::getUserOrders(getDatabaseConnection(), $username);
        Order::filterOrders($orderList, $_GET['filter']);
        print_r($orderList);?>
    </div>
    <?php };?>