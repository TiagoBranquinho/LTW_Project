<?php
include_once('templates/common.tpl.php');
include_once ('database/utils.php');
$dishCategories = getDishCategories(getDatabaseConnection());
output_header();
?>
<main>
    <h1>Add New Restaurant</h1>
    <form action="action_addDish.php" id="registerRestaurant" method="POST" enctype="multipart/form-data">
        <fieldset class="register">
            <div class="inputbox">
                <label for="dishName">Dish Name*:</label>
                <input type="text" name="dishName" placeholder="Restaurant Name" required="true">
            </div>
            <div class="inputbox">
                <label for="dishCategory">Dish Category*:</label>
                <select id="dishCategory">
                    <?php foreach ($dishCategories as $dishCategory) { ?>
                        <option value="<?php echo $dishCategory?>"><?php echo $dishCategory?></option>
                   <?php } ?>
                </select>
            </div>
            <div class="inputbox">
                <label for="dishPrice">Dish Price*:</label>
                <input type="number" name="dishPrice" placeholder="address" required="true">
            </div>
            <div class="inputbox">
                <label for="dishImage">Restaurant Image: </label>
                <input type="file" name="dishImage" accept="image/png,image/jpeg"/>
            </div>
            <button type="submit">Register</button>
        </fieldset>
    </form>
</main>
<?php output_footer(); ?>
