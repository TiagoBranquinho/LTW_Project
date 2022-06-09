<?php
  declare(strict_types = 1);
  include_once('database/connection.db.php');
  include_once('database/utils.php');

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
    if($filter != "None"){
      foreach($restaurantList as $restaurantItem){
        if($restaurantItem->category === $filter)
          $newArr[] = $restaurantItem;
      }
    }
    if(isset($newArr)){
      $restaurantList = $newArr;
      return 1;
    }
    else 
      return 0;
  }
}
?>