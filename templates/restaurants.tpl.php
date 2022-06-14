<?php 
    include_once('database/connection.db.php');
    include_once('database/restaurant.class.php');
    include_once ('database/image.class.php');
    function output_restaurant_list() { ;?>
        <main>
            <div class="restaurantCategory">
                <h1>Restaurants</h1>
                <h4>Filter by Category:</h4>
                <form action="action_restaurants_categories.php" method="POST">
                    <select name="restaurantCategory"> <!-- MISSING CSS -->
                        <option disabled selected value><h6>Category</h6></option>
                        <option value="All">All</option>
                        <option value="Gourmet">Gourmet</option>
                        <option value="Asian">Asian</option>
                        <option value="Italian">Italian</option>
                        <option value="Fast Food">Fast Food</option>
                        <option value="Cheap">Cheap</option>
                    </select>
                    <button type="submit">Filter</button>
                </form>
            </div>
            <ul id="restaurants">
            <?php $restaurantList = Restaurant::getRestaurants(getDatabaseConnection());
            Restaurant::filterRestaurants($restaurantList, $_GET['filter']);
            foreach($restaurantList as $restaurantItem) {
                $imageObject = Image::getImage(getDatabaseConnection(),$restaurantItem->imageID);
                $imagePath = $imageObject->getPath();
                output_restaurant_item($restaurantItem, $imagePath);
            };?>
            </ul>
        </main>
        
        
    <?php }

    function output_restaurant_item(Restaurant $restaurant, string $imagePath){;?>
        <li>
            <article class="restaurant">
                <section id="name">
                    <?php echo "<h3>" . $restaurant->name . "</h3>";
                    echo "<h4>Category: " . $restaurant->category . "</h4>";
                    echo "<h5>Morada: " . $restaurant->address . "</h5>";?>
                </section>
                <section id="images">
                    <img src="<?php echo $imagePath ?>" alt="logopic">
                </section>
                <section id="buttons">
                    <?php echo "<a href='restaurant.php?id=".$restaurant->restaurantID."&filter=All'>Menu</a>";?>
                    <a>Reviews</a>  <!-- NOT DONE YET -->
                </section>
            </article>
        </li>
    <?php };?>

    