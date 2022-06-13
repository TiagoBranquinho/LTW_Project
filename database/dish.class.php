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
}

?>