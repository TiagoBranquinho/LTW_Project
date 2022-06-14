<?php 
    include_once('database/connection.db.php');
    include_once('database/restaurant.class.php');
    include_once('database/dish.class.php');
    include_once('templates/dish.tpl.php');

    function output_restaurant_info(int $id){
        $restaurant = Restaurant::getRestaurant(getDatabaseConnection(), $id);?>
        <main>
            <?php echo "<h1>" . $restaurant->name . "</h1>";?>
            <div class="restaurantHeader">
                <div>
                    <?php echo "<h4>Category: " . $restaurant->category . "</h4>";
                    echo "<h4>" . $restaurant->address . "</h4>";?>
                    <h3>Rating: 4.2</h3>  <!-- NOT WORKING -->
                </div>
                <img src="https://picsum.photos/400/300" alt="logopic">
            </div>
    <?php };

    function output_restaurant_dishes(int $id, string $filter){
        $_SESSION['restaurantIdDishes'] = $id;
        $dishes= Dish::getRestaurantDishes(getDatabaseConnection(), $id);?>
        <div class="restaurantFilter">
            <h4>Filter by Category:</h4>
            <form action="action_restaurant_dishes_category.php" method="POST">
                <select name="dishCategory">
                    <?php $categories = Dish::getCategories(getDatabaseConnection());
                    foreach($categories as $category){
                        if($category['kind'] === $_GET['filter']){
                            echo  "<option selected value='" . $category['kind'] . "'>" . $category['kind'] . "</option>";
                        }
                        else{
                            echo  "<option value='" . $category['kind'] . "'>" . $category['kind'] . "</option>";
                        }
                    };?>
                </select>
                <?php echo "<input type='hidden' name='id' value='". $_SESSION['restaurantIdDishes'] . "'>";?>
                <button type='submit'>Filter</button>
            </form>
        </div>
        <?php Dish::filterDishes($dishes, $filter);?>
    
        <form class="restaurantDishes" action="action_order.php" method="POST">
            <?php foreach($dishes as $dish){
                output_restaurant_dish($dish);
            };?>
            <div>
                <div class='price'>
                    <h3>Total: </h3>
                    <h3 class='value'>00.00</h3>
                </div>
                <?php echo "<input type='hidden' name='restaurantID' value='". $id . "'>";?>
                <?php echo "<input type='hidden' name='resquestsNr' value='" . sizeof($dishes) . "'>";?>
                <button type='submit'>Checkout</button>
            </div>
        </form>
    </main>
    <?php };?>

    