<?php
include_once('templates/common.tpl.php');
include_once ('database/dish.class.php');
include_once ('database/utils.php');
$dishCategories = Dish::getCategories(getDatabaseConnection());
array_shift($dishCategories);
output_header();
?>
<main>
    <h1>Add New </h1>
    <form action="action_add_dish.php" id="registerRestaurant" method="POST" enctype="multipart/form-data">
        <fieldset class="register">
            <div class="inputbox">
                <label for="dishName">Dish Name*:</label>
                <input type="text" name="dishName" placeholder="Dish Name" required="true">
            </div>
            <div class="inputbox">
                <label for="dishCategory">Dish Category*:</label>
                <select name="dishCategory" required="true">
                    <?php foreach ($dishCategories as $dishCategory) { ?>
                        <option value="<?php echo $dishCategory['kind']?>"><?php echo $dishCategory['kind']?></option>
                   <?php } ?>
                </select>
            </div>
            <div class="inputbox">
                <label for="dishPrice">Dish Price*:</label>
                <input type="number" name="dishPrice" placeholder="Dish Price" required="true">
            </div>
            <div class="inputbox">
                <label for="dishDiscount">Dish Discount:</label>
                <input type="number" name="dishDiscount" placeholder="Dish Discount" min="0.1" max="1">
            </div>
            <div class="inputbox">
                <label for="dishImage">Dish Image: </label>
                <input type="file" name="dishImage" accept="image/png,image/jpeg"/>
            </div>
            <input type="number" name="restaurantID" value="<?php echo $_GET['id']?>" style="display: none">
            <button type="submit">Add Dish</button>
        </fieldset>
    </form>
</main>
<?php output_footer(); ?>
