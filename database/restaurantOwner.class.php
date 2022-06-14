<?php
    declare(strict_types = 1);
    include_once("database/user.class.php");
    include_once("database/image.class.php");

    class RestaurantOwner extends User {
        private string $restaurantID;

        static function getRO(string $username) {
            $db = getDatabaseConnection();
            $stmt = $db->prepare('SELECT username FROM RestaurantOwner WHERE username = ?');
            $stmt->execute([strtolower($username)]);
            return $stmt->fetch();
        }

        /**
         * @return string
         */
        public function getRestaurantID(): string
        {
            return $this->restaurantID;
        }

        /**
         * @param string $restaurantID
         */
        public function setRestaurantID(string $restaurantID): void
        {
            $this->restaurantID = $restaurantID;
        }

        static function isUserOwner(PDO $db, int $id, string $username): bool {
            $stmt  = $db->prepare('SELECT * 
                                     FROM RestaurantOwner
                                     WHERE restaurantID = ? AND username = ?');
            $stmt->execute([$id,$username]);

            if($stmt->fetch() == null) return false;

            return true;
        }

        static function registerRestaurantOwner(PDO $db, RestaurantOwner $restaurantOwner, Restaurant $restaurant, bool $customer): bool {
            $stmt = $db->prepare("SELECT * FROM RestaurantOwner WHERE RestaurantOwner.username = ?");
            $stmt->execute([$restaurantOwner->username]);
            $user = $stmt->fetch();

            if($user){
                return false;
            } else {

                $tempname = $_FILES['restaurantImage']['tmp_name'];
                $folder =  "img/restaurants/".$restaurant->getName();
                mkdir($folder);
                $imagePath = $folder."/".$restaurant->getName().".png";

                if(move_uploaded_file($tempname,$imagePath)) {
                    ?> <script> alert('File uploaded!') </script> <?php
                    $insertFilenameStmt = $db->prepare('INSERT INTO Image(path) VALUES(?)');
                    $insertFilenameStmt->execute(array($imagePath));
                } else {
                    ?> <script> alert('File upload fail!') </script> <?php
                }



                $restaurantStmt = $db->prepare('INSERT INTO Restaurant(imageID, name, category, address) VALUES(?,?,?,?)');
                $restaurantStmt = $restaurantStmt->execute(
                    array(Image::getLastestImageID($db), $restaurant->getName(),
                        $restaurant->getCategory(),
                        $restaurant->getAddress())

                );

                if(!$restaurantStmt) {
                    return false;
                } else {
                    $userStmt = $db->prepare('INSERT INTO User VALUES(?,?,?,?,?)');
                    $user = $userStmt->execute(
                        array(
                            strtolower($restaurantOwner->username),
                            sha1($_POST['password']),
                            strtolower($restaurantOwner->email),
                            $restaurantOwner->address,
                            $restaurantOwner->phoneNumber
                        )
                    );
                    if(!$user) {
                        return false;
                    } else {
                        if($customer) {
                            $customerStmt = $db->prepare('INSERT INTO Customer VALUES(?)');
                            $customerStmt->execute([$restaurantOwner->username]);
                        }

                        $restaurantOwnerStatement = $db->prepare('INSERT INTO RestaurantOwner VALUES(?,?)');
                        $restaurantOwnerStatement->execute(
                            array(
                                strtolower($restaurantOwner->username),
                                $restaurant->getRestaurantID($db,$restaurant->getName(),$restaurant->getCategory(),$restaurant->getAddress())
                            )
                        );

                        return true;
                    }
                }
            }
        }
    }
?>