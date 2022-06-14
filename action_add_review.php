<?php
  declare(strict_types = 1);
  session_start();
  include_once('database/connection.db.php');
  include_once('database/comment.class.php');
  include_once('database/review.class.php');
  include_once('database/utils.php');
  $db = getDatabaseConnection();

  if (isset($_SESSION['username'])){
    $date = date('Y/m/d H:i:s');
    $review = new Review(
        0,
        intval($_SESSION['restaurantID']),
        $_SESSION['username'],
        1,
        $_POST['title'],
        $date,
        intval($_POST['rate'])
    );
    Review::addReview($db, $review);
    $reviewID = getCurrID($db, "reviewID", "Review")-1;
    $comment = new Comment(0, $reviewID, $_SESSION['username'], $_POST['message']);
    Comment::addComment($db, $comment);
  }
  echo "rating: " . $_POST['rate'];
  header('Location: reviews.php?restID=' . $_SESSION['restaurantID']);

?>