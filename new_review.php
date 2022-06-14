<?php 
    session_start();
    include_once('database/connection.db.php');
    include_once('templates/common.tpl.php');
    include_once('database/review.class.php');
    include_once('database/restaurant.class.php');
    $db = getDatabaseConnection();
    output_header();
    $restaurant = Restaurant::getRestaurant($db, $_GET['restID']);
    $_SESSION['restaurantID'] = $_GET['restID'];
?>
<main>
    <h1>My Review</h1>
    <div class="newReview">
        <form action="action_add_review.php" id="newReviewForm" method="POST">
            <div id="input">
                <label for="RestaurantName:">Restaurant name:</label>
                <?php echo "<h3 name='RestaurantName'>". $restaurant->name . "</h3>";?>
            </div>
            <div id="input">
                <label for="title">Review title*:</label>
                <input type="text" name="title" placeholder="Your title" required="true">
            </div>
            <div id="input">
                <label for="message">Review message*:</label>
                <input type="text" name="message" placeholder="Your message" required="true">
            </div>
            <div class="rate" id="input">
                <input type="radio" id="star5" name="rate" value="5" />
                <label for="star5" title="text">5 stars</label>
                <input type="radio" id="star4" name="rate" value="4" />
                <label for="star4" title="text">4 stars</label>
                <input type="radio" id="star3" name="rate" value="3" />
                <label for="star3" title="text">3 stars</label>
                <input type="radio" id="star2" name="rate" value="2" />
                <label for="star2" title="text">2 stars</label>
                <input type="radio" id="star1" name="rate" value="1" />
                <label for="star1" title="text">1 star</label>
            </div>
            <button type="submit">Publish</button>
        </form>
    </div>
</main>
<?php output_footer();?>