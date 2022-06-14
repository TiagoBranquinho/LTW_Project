<?php
include_once('templates/restaurants.tpl.php');
include_once('database/restaurant.class.php');
include_once('templates/common.tpl.php');
include_once('database/image.class.php');
output_header();
$ownersRestaurants = Restaurant::getRestaurantsFromRestaurantOwner(getDatabaseConnection(),$_SESSION['username']);
?>
<main>
    <div class="myRestaurants">
        <h1>My Restaurants</h1>
        <a href="add_restaurant.php">
            <button>Add New Restaurant</button>
        </a>
    </div>
<ul id="restaurants">
<?php
foreach($ownersRestaurants as $restaurant) {
    $imageObject = Image::getImage(getDatabaseConnection(),$restaurant->imageID);
    output_restaurant_item($restaurant,$imageObject->path);
};?>
</ul>
</main>

<?php output_footer();?>