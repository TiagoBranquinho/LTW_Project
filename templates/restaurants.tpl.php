<?php 
    include_once('database/connection.db.php');
    include_once('database/restaurant.class.php');
    include_once ('database/image.class.php');

    function output_restaurant_list(string $filter){;?>
        <main>
            <div class="restaurantCategory">
                <h1>Restaurants</h1>
                <h4>Filter by Category:</h4>
                <form action="action_restaurants_categories.php" method="POST">
                    <select name="restaurantCategory"> <!-- MISSING CSS -->
                        <?php $categories = Restaurant::getCategories(getDatabaseConnection());


                        foreach($categories as $category){
                            if($category['kind'] === $filter){
                                echo  "<option selected value='" . $category['kind'] . "'>" . $category['kind'] . "</option>";
                            }
                            else{
                                echo  "<option value='" . $category['kind'] . "'>" . $category['kind'] . "</option>";
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
            </div>
            <ul id="restaurants">
            <?php if(!isset($_SESSION['username']))
                $username = "";
                else
                  $username = $_SESSION['username'];
            $restaurantList = Restaurant::getRestaurants(getDatabaseConnection(), $username, $_GET['fav']);
            Restaurant::filterRestaurants($restaurantList, $filter);
            foreach($restaurantList as $restaurantItem) {
                $imageObject = Image::getImage(getDatabaseConnection(),$restaurantItem->imageID);
                $imagePath = $imageObject->getPath();
                output_restaurant_item($restaurantItem, $imagePath);
            };?>
            </ul>
        </main>
        
        
    <?php }

    function output_restaurant_item(Restaurant $restaurant, string $imagePath){
        $rating = floatval(Restaurant::getRating(getDatabaseConnection(),$restaurant->restaurantID));?>
        <li>
            <article class="restaurant">
                <section id="name">
                    <?php echo "<h3>".$rating."<span class='fa fa-star checked'></span>" . " " . $restaurant->name . " </h3>";
                    echo "<h4>Category: " . $restaurant->category . "</h4>";
                    echo "<h5>Morada: " . $restaurant->address . "</h5>";?>
                </section>
                <section id="images">
                    <img src="<?php echo $imagePath ?>" alt="logopic">
                </section>
                <section id="buttons">
                    <?php echo "<a href='restaurant.php?id=".$restaurant->restaurantID."&filter=All'>Menu</a>";?>
                    <?php echo "<a href='reviews.php?restID=".$restaurant->restaurantID."'>Reviews</a>";?>
                    <?php if (isset($_SESSION['customer'])){
                        if($_SESSION['customer']) { ?>
                        <form action="../action_set_restaurant_as_favorite.php" method="POST">
                            <?php if(User::checkIfRestaurantAsFavourite(getDatabaseConnection(),$_SESSION['username'],$restaurant->restaurantID)) { ?>
                                    <input type="number" style="display: none" value="1" name="isFavourite">
                                <button type="submit">Remove from favourite</button>
                            <?php } else { ?>
                                <input type="number" style="display: none" value="0" name="isFavourite">
                                <button type="submit">Set as favourite</button>
                            <?php } ?>
                            <input type="text" style="display: none" value="<?php echo $_SESSION['username'] ?>" name="username">
                            <input type="text" style="display: none" value="<?php echo $restaurant->restaurantID ?>" name="restaurantID">
                        </form>
                    <?php }} ?>
                </section>
            </article>
        </li>
    <?php };?>

    