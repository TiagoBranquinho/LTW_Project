<?php
include_once('templates/common.tpl.php');
include_once('database/restaurant.class.php');
include_once('database/connection.db.php');
output_header();
?>
<main>
    <h1>Add New Restaurant</h1>
    <form action="action_registerRestaurant.php" id="registerRestaurant" method="POST" enctype="multipart/form-data">
        <fieldset class="register">
            <div class="inputbox">
                <label for="restaurantName">Restaurant Name*:</label>
                <input type="text" name="restaurantName" placeholder="Restaurant Name" required="true">
            </div>
            <div class="inputbox">
                <label for="restaurantCategory">Restaurant Category*:</label>
                <select id="restaurantCategory" name="restaurantCategory" required="true">
                    <?php $categories = Restaurant::getCategories(getDatabaseConnection());
                    array_shift($categories);
                    foreach($categories as $category){
                        echo "<option value='" . $category['kind'] . "'>" . $category['kind'] . "</option>";
                    }?>
                </select>
            </div>
            <div class="inputbox">
                <label for="restaurantAddress">Address*:</label>
                <input type="text" name="restaurantAddress" placeholder="address" size="50" required="true">
            </div>
            <div class="inputbox">
                <label for="restaurantImage">Restaurant Image: </label>
                <input type="file" name="restaurantImage" accept="image/png,image/jpeg"/>
            </div>
            <button type="submit">Register</button>
        </fieldset>
    </form>
</main>
<?php output_footer(); ?>
