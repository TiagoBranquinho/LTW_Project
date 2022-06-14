<?php
    declare(strict_types = 1);
    include_once('database/connection.db.php');
    include_once('database/utils.php');
    include_once('database/review.class.php');

    class Comment{
        public int $commentID;
        public int $reviewID;
        public string $username;
        public string $message;

        public function __construct(int $commentID, int $reviewID, string $username, string $message){
            $this->commentID = $commentID;
            $this->reviewID = $reviewID;
            $this->username = $username;
            $this->message = $message;
        }

        static function addComment(PDO $db, Comment $comment){
            $stmt = $db->prepare('INSERT INTO Comment(reviewId, username, message) VALUES(?,?,?)');
            $stmt->execute(
                array(
                    $comment->reviewID,
                    $comment->username,
                    $comment->message
                )
            );
        }

        static function getComments(PDO $db, Review $review) {
            $stmt = $db->prepare('SELECT * FROM Comment WHERE reviewID=?');
            $stmt->execute(array($review->reviewID));
    
            $comments = array();
            while($comment = $stmt->fetch()){
                $thisComment= new Comment(
                    $comment['commentID'],
                    $comment['reviewID'],
                    $comment['username'],
                    $comment['message']
                );
                array_push($comments, $thisComment);
            }
            return $comments;
        }

    }
?>