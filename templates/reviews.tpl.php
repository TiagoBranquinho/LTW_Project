<?php
    declare(strict_types = 1);
    session_start();
    include_once('database/connection.db.php');
    include_once('database/review.class.php');
    include_once('database/comment.class.php');
    include_once('database/restaurant.class.php');
    
    function output_restaurant_reviews(int $restaurantID){;?>
        <main>
            <div class="reviewsCategory">
                <h1>Reviews</h1>
                <?php if (isset($_SESSION['username']) && Restaurant::isRestaurantUsedBy(getDatabaseConnection(), $_SESSION['username'], $restaurantID)){ ?>
                    <section class="buttons">
                        <?php echo "<a id='addReview' href='new_review.php?restID=" . $restaurantID . "'>New Review</a>"; ?>
                    </section>
                <?php } ?>
            </div>
                <ul id="reviews">
                    <?php
                        $reviews = Review::getReviews(getDatabaseConnection(), $restaurantID);
                        foreach($reviews as $review){
                            output_restaurant_review($review);
                        };
                    ?>
                </ul>
        </main>
    <?php }

    function output_restaurant_review(Review $review){;?>
    <li>
        <div id="name">
            <h3><?php echo $review->title;?></h3>
            <h3><?php echo $review->datetime;?></h3>
            <h3><?php echo $review->score;?><span class="fa fa-star checked"></span></h3>
        </div>
        <article class = "review">
            <?php 
                $_SESSION['reviewID'] = $review->reviewID;
                $comments = Comment::getComments(getDatabaseConnection(), $review);

                foreach($comments as $comment){?> 
                <div id="comment">
                    <?php
                    echo "<div id='user'>".$comment->username."</div>";
                    echo "<div id='message'>".$comment->message."</div>";
                    ?>
                </div>
                <?php 
                };

                if (isset($_SESSION['username'])){?>
                    <form id="commentSection" action="action_add_comment.php" method="POST">
                        <input id="inputComment" type="text" name="comment" id="comment" placeholder="Enter your comment" required="true">
                        <button type="submit" value="Submit"> Comment </button>
                    </form>
                <?php
                }?>
        </article>
    </li>
    <?php }


?>