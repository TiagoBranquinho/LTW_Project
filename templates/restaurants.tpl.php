<?php 
    include_once('database/connection.db.php');
    include_once('database/restaurant.class.php');

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
                    <button type="submit">Filter</button>
                </form>
            </div>
            <ul id="restaurants">
            <?php $restaurantList = Restaurant::getRestaurants(getDatabaseConnection());
            Restaurant::filterRestaurants($restaurantList, $filter);

            foreach($restaurantList as $restaurantItem){
                output_restaurant_item($restaurantItem);
            };?>
            </ul>
        </main>
        
        
    <?php }

    function output_restaurant_item(Restaurant $restaurant){;?>
        <li>
            <article class="restaurant">
                <section id="name">
                    <?php echo "<h3>" . $restaurant->name . "</h3>";
                    echo "<h4>Category: " . $restaurant->category . "</h4>";
                    echo "<h5>Morada: " . $restaurant->address . "</h5>";?>
                </section>
                <section id="images">
                    <img src="https://picsum.photos/120/100" alt="logopic">
                    <img src="https://picsum.photos/120/100" alt="logopic">
                    <img src="https://picsum.photos/120/100" alt="logopic">
                </section>
                <section id="buttons">
                    <?php echo "<a href='restaurant.php?id=".$restaurant->restaurantID."&filter=All'>Menu</a>";?>
                    <?php echo "<a href='reviews.php?restID=".$restaurant->restaurantID."'>Reviews</a>";?>
                </section>
            </article>
        </li>
    <?php };?>

    