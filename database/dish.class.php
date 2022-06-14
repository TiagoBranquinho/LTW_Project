<?php
  declare(strict_types = 1);
  include_once('database/connection.db.php');

  class Dish {
    public int $dishID;
    public string $name;
    public int $imageID;
    public int $restaurantID;
    public float $price;
    public string $category;
    public float $discount;

    public function __construct(string $name, int $restaurantID, float $price, string $category, float $discount)
    {
      $this->name = $name;
      $this->restaurantID = $restaurantID;
      $this->price = $price;
      $this->category = $category;
      $this->discount = $discount;
    }

    static function addDishToRestaurant(PDO $db, Dish $dish): bool {
        $tempname = $_FILES['dishImage']['tmp_name'];
        $stmt = $db->prepare('SELECT name FROM Restaurant WHERE restaurantID = ?');
        $stmt->execute([$dish->restaurantID]);
        $restaurant = $stmt->fetch();
        $folder =  "img/restaurants/".$restaurant['name'];
        $imagePath = $folder."/".$dish->name.".png";

        if(move_uploaded_file($tempname,$imagePath)) {
            ?> <script> alert('File uploaded!') </script> <?php
            $insertFilenameStmt = $db->prepare('INSERT INTO Image(path) VALUES(?)');
            $insertFilenameStmt->execute(array($imagePath));
            $dish->imageID = Image::getLastestImageID($db);
            $stmt = $db->prepare('INSERT INTO Dish(name,imageID,restaurantID,price,category,discount) VALUES(?,?,?,?,?,?)');
            $stmt->execute([$dish->name,$dish->imageID,$dish->restaurantID,$dish->price,$dish->category,$dish->discount]);
            return true;
        } else {
            ?> <script> alert('File upload fail!') </script> <?php
            return false;
        }
    }

static function getDish(PDO $db, int $id) {
    $stmt = $db->prepare('SELECT * FROM Dish WHERE dishID = ?');
    $stmt->execute(array($id));

    $dish = $stmt->fetch();
    $thisDish = new Dish(
    $dish['name'],
    $dish['restaurantID'],
    $dish['price'],
    $dish['category'],
    $dish['discount']);

    $thisDish->dishID = $dish['dishID'];
    $thisDish->imageID = $dish['imageID'];
    return $thisDish;
}
static function getRestaurantDishes(PDO $db, int $id) {
    $stmt = $db->prepare('SELECT * FROM Dish WHERE restaurantID = ?');
    $stmt->execute(array($id));

    $dishes = array();
    while($dish = $stmt->fetch()){
      $thisDish = new Dish(
        $dish['name'],
        $dish['restaurantID'],
        $dish['price'],
        $dish['category'],
        $dish['discount'],
      );
      $thisDish->dishID = $dish['dishID'];
      $thisDish->imageID = $dish['imageID'];
      array_push($dishes, $thisDish);
    }
    return $dishes;
}

  static function getCategories(PDO $db) {
    $stmt = $db->prepare('SELECT kind FROM DishCategory ORDER BY kind ASC');
    $stmt->execute();

    $categories = array();
    while($category = $stmt->fetch()){
        array_push($categories, $category);
    }
    return $categories;
  }

  static function filterDishes(array &$dishes, string $filter) {
    $newArr = array();
    if($filter != "All"){
      foreach($dishes as $dish){
        if($dish->category === $filter)
            array_push($newArr, $dish);
      }
      $dishes = $newArr;
    }
  }

  static function updateDishImagePath(PDO $db, int $restID) {
    $restaurant = Restaurant::getRestaurant($db, $restID);
    $dishes = Dish::getRestaurantDishes($db, $restID);
    foreach($dishes as $dish){
      $imagePath = "img/restaurants/". $restaurant->name ."/".$dish->name.".png";
      $stmt = $db->prepare('UPDATE Image SET path=? WHERE imageID=?');
      $stmt->execute(array($imagePath, $dish->imageID));
    }
  }
}

?>