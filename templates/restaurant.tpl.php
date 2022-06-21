<?php 
    include_once('database/connection.db.php');
    include_once('database/restaurant.class.php');
    include_once('database/dish.class.php');
    include_once ('database/image.class.php');
    include_once('templates/dish.tpl.php');
    function output_restaurant_info(int $id) {
        $restaurant = Restaurant::getRestaurant(getDatabaseConnection(), $id);
        $rating = floatval(Restaurant::getRating(getDatabaseConnection(),$restaurant->restaurantID));
        if(isset($_SESSION['username']))
            $isOwner = RestaurantOwner::isUserOwner(getDatabaseConnection(),$id,$_SESSION['username']);
        $imagePath = Image::getImage(getDatabaseConnection(),$restaurant->imageID)->getPath()?>
        <main>
            <?php echo "<h1>" . $restaurant->name . "</h1>";?>
            <div class="restaurantHeader">
                <div>
                    <?php echo "<h4>Category: " . $restaurant->category . "</h4>";
                    echo "<h4>" . $restaurant->address . "</h4>";
                    echo "<h3> Rating: " . $rating . "<span class='fa fa-star checked'></span></h3>";?>
                </div>
                <img src="<?php echo $imagePath?>" alt="logopic" width="400" height="300">
                <?php if(isset($isOwner)) {
                    if($isOwner){ ?>
                    <a href="edit_restaurant.php?id=<?php echo $id?>">
                        <button>Edit</button>
                    </a>
                    <a href="add_dish.php?id=<?php echo $id?>">
                        <button>Add dish</button>
                    </a>
                    <a href="check_orders.php?id=<?php echo $id?>">
                        <button>Check Orders</button>
                    </a>
                <?php }} ?>
            </div>
    <?php };

    function output_restaurant_dishes(int $id, string $filter){
        $dishes = Dish::getRestaurantDishes(getDatabaseConnection(), $id);
        if(!isset($_SESSION['username']))
            $username = "";
        else
            $username = $_SESSION['username'];
        $isOwner = RestaurantOwner::isUserOwner(getDatabaseConnection(),$id,$username)?>
        <div class="restaurantFilter">
            <h4>Filter by Category:</h4>
            <form action="action_restaurant_dishes_category.php" method="POST">
                <select name="dishCategory">
                    <?php $categories = Dish::getCategories(getDatabaseConnection());
                    foreach($categories as $category){
                        if($category['kind'] === $filter){
                            echo  "<option selected value='" . $category['kind'] . "'>" . $category['kind'] . "</option>";
                        }
                        else{
                            echo  "<option value='" . $category['kind'] . "'>" . $category['kind'] . "</option>";
                        }
                    };?>
                </select>
                <?php echo "<input type='hidden' name='id' value='". $id . "'>";?>
                <button type='submit'>Filter</button>
            </form>
        </div>
        <?php Dish::filterDishes($dishes, $filter);?>
    
        <form class="restaurantDishes" action="action_order.php" method="POST">
            <?php foreach($dishes as $dish){
                output_restaurant_dish($dish);
            };?>
            <?php if(isset($isOwner)){
            if (!$isOwner) { ?>
            <div>
                <div class='price'>
                    <h3>Total: </h3>
                    <h3 class='value'>00.00</h3>
                </div>
                <?php echo "<input type='hidden' name='restaurantID' value='". $id . "'>";?>
                <?php echo "<input type='hidden' name='resquestsNr' value='" . sizeof($dishes) . "'>";?>
                <button type='submit'>Checkout</button>
            </div>
            <?php }} ?>
        </form>
    </main>
    <?php };?>

    