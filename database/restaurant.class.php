<?php
  declare(strict_types = 1);
  include_once('database/connection.db.php');
  include_once('database/utils.php');
  include_once('database/dish.class.php');

  class Restaurant {
    public int $id;
    public string $name;
    public int $imageId;
    public string $category;
    public string $address;

    public function __construct(int $id, string $name, int $imageId, string $category, string $address)
    {
        if($id == 0){
           $this->id = getCurrID(getDatabaseConnection(), "restaurantID", "Restaurant");
        }
        else{
            $this->id = $id;
        }
      $this->name = $name;
      $this->imageId = $imageId;
      $this->category = $category;
      $this->address = $address;
    }

    static function registerRestaurant(PDO $db, Restaurant $restaurant) {
      $stmt = $db->prepare("SELECT * FROM Restaurant WHERE restaurant.restaurantID = ?");
      $stmt->execute([$restaurant->id]);
      $present = $stmt->fetch();

      if($present){
          return false;
      }
      else{
        $stmt = $db->prepare('INSERT INTO Restaurant VALUES(?,?,?,?,?)');
        $stmt->execute(array($restaurant->id, $restaurant->name, $restaurant->imageId, $restaurant->category, $restaurant->address));
        return true;
      }
    }

    static function editRestaurant(PDO $db, Restaurant $restaurant) {
      $stmt = $db->prepare("UPDATE Restaurant SET name = ?, imageID = ?, category = ? , address = ? WHERE restaurant.restaurantID = ?");
      $stmt->execute([$restaurant->name, $restaurant->imageId, $restaurant->category, $restaurant->address]);
    }

    static function getRestaurants(PDO $db) {
        $stmt = $db->prepare('SELECT * FROM Restaurant');
        $stmt->execute();

        $restaurants = array();
        while($restaurant = $stmt->fetch()){
            array_push($restaurants, new Restaurant(
                $restaurant['restaurantID'],
                $restaurant['name'],
                $restaurant['imageID'],
                $restaurant['category'],
                $restaurant['address']
            ));
        }
        return $restaurants;
  }

  static function getRestaurant(PDO $db, int $id) {
    $stmt = $db->prepare('SELECT * FROM Restaurant WHERE restaurantID = ?');
    $stmt->execute(array($id));

    $restaurant = $stmt->fetch();
    return new Restaurant($restaurant['restaurantID'],
    $restaurant['name'],
    $restaurant['imageID'],
    $restaurant['category'],
    $restaurant['address']);
}

static function getRestaurantDishes(PDO $db, int $id) {
    $stmt = $db->prepare('SELECT * FROM Dish WHERE restaurantID = ?');
    $stmt->execute(array($id));

    $dishes = array();
    while($dish = $stmt->fetch()){
        array_push($dishes, new Dish(
            $dish['dishID'],
            $dish['name'],
            $dish['imageID'],
            $dish['restaurantID'],
            $dish['price'],
            $dish['category'],
            $dish['discount']
        ));
    }
    return $dishes;
}

  static function getCategories(PDO $db) {
    $stmt = $db->prepare('SELECT * FROM Category');
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