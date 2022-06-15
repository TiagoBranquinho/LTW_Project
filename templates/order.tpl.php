<?php include_once('database/connection.db.php');
    include_once('database/order.class.php');
    include_once('database/restaurant.class.php');
    include_once ('database/image.class.php');
function output_order(int $id, string $username){;
    $dishes = Order::getOrderDishes(getDatabaseConnection(), $id, $username);
    $orders = Order::getOrders(getDatabaseConnection(), $id);
    ?>
    <main>
    <div class="order">
        <div class="orderinfo">
            <?php echo "<h1>" . Restaurant::getRestaurant(getDatabaseConnection(), $orders[0]->restaurantID)->name . "</h1>";
            echo "<h4>" . Restaurant::getRestaurant(getDatabaseConnection(), $orders[0]->restaurantID)->address . "</h4>";
            echo "<h4>Order number: " . $id . "</h4>"?>
        </div>
        <div class="ordercheckout">
            <div class='price'>
                <h3>Total: </h3>
                <?php echo "<h3 class='value'>" . Order::getOrderPrice(getDatabaseConnection(), $id) . "</h3>";?>
            </div>
        <div class="dishes">
            <?php foreach($dishes as $dish){
                output_order_dish($id, $dish);
            }?>
        </div>
        <div class="orderResume">
        <h4>Payment Method: Monetary</h4>
        <?php echo "<h4>Status: " . $orders[0]->state . "</h4>";?>
        <a href="my_orders.php?filter=All&fav=off">Back to My Orders</a>
        </div>
    </div>
</main>
<?php }
function output_order_dish(int $id, Dish $dish){;?>
    <article>
                <section>
                    <?php echo "<h2>" . $dish->name . "</h2>";?>
                    <div class="price">
                        <h4>Price: </h4>
                        <?php echo "<h4 class='value'>" . Order::getOrderPrice(getDatabaseConnection(), $id) . "</h4>";?>
                    </div>
                    <?php echo "<h4>Category: " . $dish->category . "</h4>";?>
                    <?php echo "<h4>Quantity: " . Order::getOrderDishQuantity(getDatabaseConnection(), $id, $dish->dishID) . "</h4>";?>
                </section>
                <section>
                    <img src="<?php echo Image::getImage(getDatabaseConnection(),$dish->imageID)->getPath()?>" alt="logopic">
                </section>
            </article>
<?php }?>