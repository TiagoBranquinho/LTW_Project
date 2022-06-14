<?php
  declare(strict_types = 1);
  include_once('database/connection.db.php');
  include_once('database/utils.php');
  include_once('database/restaurant.class.php');
  include_once('database/comment.class.php');
  
  class Review {
    public int $reviewID;
    public int $restaurantID;
    public int $imageID;
    public string $username;
    public string $title;
    public string $datetime;
    public float $score;

    public function __construct(int $reviewID, int $restaurantID, string $username, int $imageID,string $title, string $datetime, float $score)
    {
      $this->reviewID = $reviewID;
      $this->restaurantID = $restaurantID;
      $this->username = $username;
      $this->imageID = $imageID;
      $this->title = $title;
      $this->datetime = $datetime;
      $this->score = $score;
    }

    static function addReview(PDO $db, Review $review) {;
        $stmt = $db->prepare('INSERT INTO Review(restaurantID, username, imageID, title, datetime, score) VALUES(?,?,?,?,?,?)');
        $stmt->execute(
            array(
            $review->restaurantID,
            $review->username, 
            $review->imageID, 
            $review->title,
            $review->datetime,
            $review->score,
        ));
    }


    static function getReviews(PDO $db, int $restaurantID) {
        $stmt = $db->prepare('SELECT * FROM Review WHERE restaurantID=?');
        $stmt->execute(array($restaurantID));

        $reviews = array();
        while($review = $stmt->fetch()){
            $thisReview = new Review(
                $review['reviewID'],
                $review['restaurantID'],
                $review['username'],
                $review['imageID'],
                $review['title'],
                $review['datetime'],
                $review['score']
            );
            array_push($reviews, $thisReview);
        }
        return $reviews;
    }

    static function getReview(PDO $db, int $id) {
        $stmt = $db->prepare('SELECT * FROM Review WHERE reviewID = ?');
        $stmt->execute(array($id));

        $restaurant = $stmt->fetch();
        return new Review(
            $review['reviewID'],
            $review['restaurantID'],
            $review['username'],
            $review['imageID'],
            $review['title'],
            $review['datetime'],
            $review['score']
        );
    }


    static function filterReviews(array &$reviews, float $score) {
        $newArr = array();
        foreach($reviews as $review){
        if($review->score >= $score)
            array_push($newArr, $restaurantItem);
        }
        $reviews = $newArr;
    }
}
?>