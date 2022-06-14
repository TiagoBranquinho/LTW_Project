<?php
    declare (strict_types = 1);
    include_once('database/connection.db.php');
    include_once('database/order.class.php');
    include_once('database/restaurant.class.php');
    include_once('database/dish.class.php');
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
            <label class="switch">
            <?php if($_GET['fav'] ===  "on"){
                    echo "<input type='checkbox' checked>";
                 }
                  else{
                    echo "<input type='checkbox'>";
                  };?>
            <span class="slider round"></span>
            </label>
            <?php echo "<input type='hidden' name='fav' value='" . $_GET['fav'] . "'>";?>
         <button type="submit">Filter</button>
        </form>
        <?php $orderList = Order::getUserOrders(getDatabaseConnection(), $username, $_GET['fav']);
        Order::filterOrders($orderList, $_GET['filter']);?>
        </div>
        <ul id="orders">
        <?php foreach($orderList as $order){
            ouput_my_order($order);
        }?>
        </ul>
    </main>
    <?php }
    
    function ouput_my_order(Order $order){;?>
        <li>
            <article class="order">
                <section>
                    <?php echo "<h2>" . Restaurant::getRestaurant(getDatabaseConnection(), $order->restaurantID)->name ."</h2>"?>
                </section>
                <section>
                    <div>
                        <?php echo "<h4>Order number #". $order->orderID . "</h4>";
                        echo "<h4>Dishes Ordered: " . Order::getNumDishes(getDatabaseConnection(), $order->orderID) . "</h4>";?>
                        <div class="price">
                        <h4>Price: </h4>
                        <?php echo "<h4 class='value'>" . Order::getOrderPrice(getDatabaseConnection(), $order->orderID) . "</h4>";?>
                    </div>
                    </div>
                    <?php echo "<h3>State: " . $order->state . "</h3>";?>
                </section>
            </article>
        </li>
 <?php };?>