<?php
    session_start();
    include_once('templates/common.tpl.php');
    include_once('database/connection.db.php');
    include_once('database/restaurant.class.php');
    include_once('database/image.class.php');
    output_header();
?>
<main>
    <div id="welcome">
        <div id="bigLogo">
            <img src="img/assets/food-center-logo.svg" alt="logopic">
        </div>
        <div id="search">
            <h1>Welcome!</h1>
            <?php if(isset($_SESSION['customer']) || !isset($_SESSION['username'])){?>
                <h2>Search Restaurants Here</h2>
            <div class="dropdown">
  <button onclick="myFunction()" class="dropbtn">&#8595</button>
  <div id="myDropdown" class="dropdown-content">
    <?php $restaurants = Restaurant::getRestaurants(getDatabaseConnection(), "none", "off");
    foreach($restaurants as $restaurant){?>
        <div id="restaurantIndex">
        <?php echo "<a href='restaurant.php?filter=All&id=" . $restaurant->restaurantID . "'>" . $restaurant->name . " - " . $restaurant->category . "</a>";?>
        </div>
    <?php }?>
  </div>
</div>
            <?php }?>
        </div>
    </div>
</main>

<?php output_footer();?>