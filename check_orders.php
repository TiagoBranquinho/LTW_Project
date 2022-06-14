<?php 
    include_once('templates/common.tpl.php');
    include_once('database/order.class.php');
    include_once('database/restaurant.class.php');
    include_once('templates/my_orders.tpl.php');
    output_header();?>
    <main>
        <?php echo "<h1>" . Restaurant::getRestaurant(getDatabaseConnection(), $_GET['id'])->name . " Orders</h1>";
     $orderList = Restaurant::getRestaurantOrders(getDatabaseConnection(), $_GET['id']);?>
        </div>
        <ul id="orders">
        <?php foreach($orderList as $order){
            ouput_my_restaurant_order($order);
        }?>
        </ul>
    </main>
    <?php output_footer();?>