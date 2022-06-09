<?php
    declare(strict_types = 1);
    include_once("database/user.class.php");

    class RestaurantOwner extends User {
        private string $restaurantID;

        static function getROWithPassword(PDO $db, string $username, string $password){
            $stmt = $db->prepare('SELECT * FROM User WHERE lower(username) = ? AND password = ? AND ? IN RestaurantOwner');
            $stmt->execute(array(strtolower($username), sha1($password),strtolower($username)));
        
            if ($restaurantOwner = $stmt->fetch()){
                return new RestaurantOwner(
                    $restaurantOwner['username'],
                    $restaurantOwner['email'],
                    $restaurantOwner['address'],
                    $restaurantOwner['phoneNumber'],
                );
            }
            else return null;
        }

        static function registerRestaurantOwner(PDO $db, RestaurantOwner $restaurantOwner, Restaurant $restaurant, bool $customer): bool {
            $stmt = $db->prepare("SELECT * FROM RestaurantOwner WHERE RestaurantOwner.username = ?");
            $stmt->execute([$restaurantOwner->username]);
            $user = $stmt->fetch();

            if($user){
                return false;
            } else {

                $restaurantStmt = $db->prepare('INSERT INTO Restaurant(imageID, name, category, address) VALUES(?,?,?,?)');
                $restaurantStmt = $restaurantStmt->execute(
                    array(1, $restaurant->getName(),
                        $restaurant->getCategory(),
                        $restaurant->getAddress())

                );

                $filename = $_FILES['restaurantImage']['name'];
                $tempname = $_FILES['restaurantImage']['tmp_name'];
                $folder =  "img/restaurants/".$restaurant->getName();
                mkdir($folder);
                $imagePath = $folder."/".$restaurant->getName().".png";

                $insertFilenameStmt = $db->prepare('INSERT INTO Image VALUES(?,?)');
                $insertFilenameStmt->execute(array(45,$imagePath));

                if(move_uploaded_file($tempname,$imagePath)) {
                    ?> <script> alert('File uploaded!') </script> <?php
                } else {
                    ?> <script> alert('File upload fail!') </script> <?php
                }


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
                                $restaurantOwner->username,
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