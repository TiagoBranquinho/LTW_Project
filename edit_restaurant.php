<?php
session_start();
include_once ("templates/common.tpl.php");
include_once ("database/restaurant.class.php");
output_header();
$restaurant = Restaurant::getRestaurant(getDatabaseConnection(),(int)$_GET['id']);
?>

<main>
    <h1>Edit Restaurant</h1>
    <h4><strong>Note:</strong>Everything left empty will be remained the same</h4>
    <form action="action_edit_restaurant.php" id="registerRestaurant" method="POST" enctype="multipart/form-data">
        <fieldset class="register">
            <input type="number" style="display: none" name="id" value="<?php echo $_GET['id']?>">
            <div class="inputbox">
                <label for="restaurantName">New Name:</label>
                <input type="text" name="restaurantName" placeholder="<?php echo "Current Name: " . $restaurant->getName() ?>">
            </div>
            <div class="inputbox">
                <label for="restaurantCategory">New Category:</label>
                <input type="text" name="restaurantCategory" placeholder="<?php echo "Current Category: " . $restaurant->getCategory() ?>" list="categories">
                <datalist id="categories">
                    <option value="Buffet">
                    <option value="Cafe">
                    <option value="Casual dining">
                    <option value="Fast-food">
                    <option value="Fine dining">
                    <option value="Take-away">
                </datalist>
            </div>
            <div class="inputbox">
                <label for="restaurantAddress">New Address:</label>
                <input type="text" name="restaurantAddress" placeholder="<?php echo "Current Address: " . $restaurant->getAddress() ?>" size="50">
            </div>
            <div class="inputbox">
                <label for="restaurantImage">New Image: </label>
                <input type="file" name="restaurantImage" accept="image/png,image/jpeg"/>
            </div>
            <button type="submit">Edit</button>
        </fieldset>
    </form>
</main>

<?php output_footer(); ?>