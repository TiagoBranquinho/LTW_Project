<?php
  declare(strict_types = 1);
  include_once('database/connection.db.php');
  include_once('database/utils.php');
  include_once('database/dish.class.php');

  class Restaurant {
      public int $restaurantID;
      public int $imageID;
      public string $name;
      public string $category;
      public string $address;

    public function __construct(string $name, string $category, string $address)
    {
      $this->name = $name;
      $this->category = $category;
      $this->address = $address;
    }

    static function registerRestaurant(PDO $db, Restaurant $restaurant) {
        $filename = $_FILES['restaurantImage']['name'];
        $tempname = $_FILES['restaurantImage']['tmp_name'];
        $folder =  "img/restaurants/".$restaurant->getName();
        mkdir($folder);
        $imagePath = $folder."/".$restaurant->getName().".png";

        $insertFilenameStmt = $db->prepare('INSERT INTO Image(path) VALUES(?)');
        $insertFilenameStmt->execute(array($imagePath));

        if(move_uploaded_file($tempname,$imagePath)) {
            ?> <script> alert('File uploaded!') </script> <?php
        } else {
            ?> <script> alert('File upload fail!') </script> <?php
        }

        $imgStmt = $db->prepare('SELECT imageID FROM Image ORDER BY imageID DESC LIMIT 1');
        $imgStmt->execute();
        $imageID = $imgStmt->fetch();
        $imageID = $imageID['imageID'];

        $stmt = $db->prepare('INSERT INTO Restaurant(imageID, name, category, address) VALUES(?,?,?,?)');
        $stmt->execute(array($imageID, $restaurant->name, $restaurant->category, $restaurant->address));

        $restaurantOwnerStatement = $db->prepare('INSERT INTO RestaurantOwner VALUES(?,?)');
        $restaurantOwnerStatement->execute(
            array(
                $_SESSION['username'],
                $restaurant->getRestaurantID($db,$restaurant->getName(),$restaurant->getCategory(),$restaurant->getAddress())
            )
        );

        return true;
      }


    static function editRestaurant(PDO $db, Restaurant $restaurant, string $oldRestaurantName, int $imageID) {
        if($imageID == -1) {
            $stmt = $db->prepare("UPDATE Restaurant SET name = ?, category = ? , address = ? WHERE restaurant.restaurantID = ?");
            $stmt->execute([$restaurant->name, $restaurant->category, $restaurant->address, $restaurant->restaurantID]);
        } else {
            $stmt = $db->prepare("UPDATE Restaurant SET name = ?, category = ? , address = ?, imageID = ? WHERE restaurant.restaurantID = ?");
            $stmt->execute([$restaurant->name, $restaurant->category, $restaurant->address, $imageID, $restaurant->restaurantID]);
        }
        rename("img/restaurants/".$oldRestaurantName, "img/restaurants/".$restaurant->getName());
    }

    static function getRestaurants(PDO $db) {
        $stmt = $db->prepare('SELECT * FROM Restaurant');
        $stmt->execute();

        $restaurants = array();
        while($restaurant = $stmt->fetch()){
            $thisRestaurant = new Restaurant(
                $restaurant['name'],
                $restaurant['category'],
                $restaurant['address']
            );

            $thisRestaurant->restaurantID = (int)$restaurant['restaurantID'];
            $thisRestaurant->imageID = (int)$restaurant['imageID'];
            array_push($restaurants, $thisRestaurant);
        }
        return $restaurants;
  }

  static function getRestaurantsFromRestaurantOwner(PDO $db, string $restaurantOwner) {
      $stmt = $db->prepare('SELECT * FROM Restaurant 
                                    WHERE restaurantID 
                                    IN (SELECT restaurantID 
                                        FROM RestaurantOwner
                                        WHERE username = ?)');
      $stmt->execute([$restaurantOwner]);
      $restaurants = array();
      while($restaurant = $stmt->fetch()){
          $thisRestaurant = new Restaurant(
              $restaurant['name'],
              $restaurant['category'],
              $restaurant['address']
          );

          $thisRestaurant->restaurantID = $restaurant['restaurantID'];
          $thisRestaurant->imageID = $restaurant['imageID'];
          array_push($restaurants, $thisRestaurant);
      }
      return $restaurants;
  }

  static function getRestaurant(PDO $db, int $id) {
    $stmt = $db->prepare('SELECT * FROM Restaurant WHERE restaurantID = ?');
    $stmt->execute(array($id));

    $restaurant = $stmt->fetch();
    $thisRestaurant = new Restaurant(
    $restaurant['name'],
    $restaurant['category'],
    $restaurant['address']);
    $thisRestaurant->restaurantID = $restaurant['restaurantID'];
    $thisRestaurant->imageID = $restaurant['imageID'];
    return $thisRestaurant;
}

  static function getCategories(PDO $db) {
    $stmt = $db->prepare('SELECT kind FROM Category ORDER BY kind ASC');
    $stmt->execute();

    $categories = array();
    while($category = $stmt->fetch()){
        array_push($categories, $category);
    }
    return $categories;
  }

  static function filterRestaurants(array &$restaurantList, string $filter) {
    $newArr = array();
    if($filter != "All"){
      foreach($restaurantList as $restaurantItem){
        if($restaurantItem->category === $filter)
            array_push($newArr, $restaurantItem);
      }
      $restaurantList = $newArr;
    }
  }

      /**
       * @return int
       */

      public function getRestaurantID(PDO $db, string $name, string $category, string $address): int {
          $restaurantIDStmt = $db->prepare('SELECT restaurantID FROM Restaurant WHERE name = ? AND category = ? AND address = ?');
          $restaurant = $restaurantIDStmt->execute(array(
              $name,$category,$address
          ));

          if($restaurant = $restaurantIDStmt->fetch()) return $restaurant['restaurantID'];

          return -1;
      }
      /**
       * @return string
       */
      public function getName(): string
      {
          return $this->name;
      }

      /**
       * @return string
       */
      public function getCategory(): string
      {
          return $this->category;
      }


      /**
       * @return string
       */
      public function getAddress(): string
      {
          return $this->address;
      }
}

?>