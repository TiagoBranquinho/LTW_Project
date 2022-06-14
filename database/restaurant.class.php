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

    static function registerRestaurant(PDO $db, Restaurant $restaurant, int $imageID) {;
        $stmt = $db->prepare('INSERT INTO Restaurant(imageID, name, category, address) VALUES(?,?,?,?)');
        $stmt->execute(array($imageID, $restaurant->name, $restaurant->category, $restaurant->address));
        return true;
      }


    static function editRestaurant(PDO $db, Restaurant $restaurant, int $imageID) {
        if($imageID == -1) {
            $stmt = $db->prepare("UPDATE Restaurant SET name = ?, category = ? , address = ? WHERE restaurant.restaurantID = ?");
            $stmt->execute([$restaurant->name, $restaurant->category, $restaurant->address]);
        } else {
            $stmt = $db->prepare("UPDATE Restaurant SET name = ?, category = ? , address = ?, imageID = ? WHERE restaurant.restaurantID = ?");
            $stmt->execute([$restaurant->name, $restaurant->category, $restaurant->address, $imageID]);
        }
    }

    static function getRestaurants(PDO $db, string $username, string $fav) {
      if($fav === "off"){
        $querry = 'SELECT * FROM Restaurant';
        $stmt = $db->prepare($querry);
        $stmt->execute();
      }
      else{
        $querry = 'SELECT Restaurant.restaurantID, Restaurant.imageID, Restaurant.name, Restaurant.category, Restaurant.address
                  FROM Restaurant, FavouriteRestaurant
                  WHERE Restaurant.restaurantID = FavouriteRestaurant.restaurantID and username = ?';
        $stmt = $db->prepare($querry);
        $stmt->execute(array($username));
        }

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