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

    static function registerRestaurant(PDO $db, Restaurant $restaurant, string $username) {
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
                $username,
                $restaurant->getRestaurantID($db,$restaurant->getName(),$restaurant->getCategory(),$restaurant->getAddress())
            )
        );

        return true;
      }


    static function editRestaurant(PDO $db, Restaurant $restaurant, int $imageID) {
        $stmt = $db->prepare("UPDATE Restaurant SET name = ?, category = ? , address = ?, imageID = ? WHERE restaurant.restaurantID = ?");
        $stmt->execute([$restaurant->name, $restaurant->category, $restaurant->address, $imageID, $restaurant->restaurantID]);
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

            $thisRestaurant->restaurantID = (int)$restaurant['restaurantID'];
            $thisRestaurant->imageID = (int)$restaurant['imageID'];
            array_push($restaurants, $thisRestaurant);
        }
        return $restaurants;
  }

  static function getRestaurantsFromRestaurantOwner(PDO $db, string $restaurantOwner) {
      $stmt = $db->prepare('SELECT Restaurant.restaurantID, Restaurant.imageID, Restaurant.name, Restaurant.category, Restaurant.address
       FROM Restaurant, RestaurantOwner
       WHERE Restaurant.restaurantID = RestaurantOwner.restaurantID and RestaurantOwner.username = ?');
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

  static function getRestaurantOrders(PDO $db, int $id) {
    $stmt = $db->prepare('SELECT Orders.orderID, Orders.state, Orders.restaurantID, Orders.dishID, Orders.quantity, Orders.username
     FROM Orders
     INNER JOIN Restaurant ON Orders.restaurantID=Restaurant.restaurantID
     WHERE Orders.restaurantID = ?');
    $stmt->execute([$id]);
    $orders = array();
    while($order = $stmt->fetch()){
      array_push($orders, new Order(
            $order['orderID'],
            $order['state'],
            $order['restaurantID'], 
            $order['dishID'],
            $order['quantity'],
            $order['username']
        ));
    }
    return $orders;
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

  static function isRestaurantUsedBy(PDO $db, string $username, int $restaurantID) {
    
    $stmt = $db->prepare('SELECT DISTINCT Restaurant.restaurantID
                          FROM Restaurant
                          INNER JOIN Orders ON Orders.restaurantID=Restaurant.restaurantID
                          WHERE Orders.username = ?');
    $stmt->execute(array($username));
    while($rest = $stmt->fetch()){
      if ($rest['restaurantID'] === $restaurantID){
        return true;
      }
    }
    return false;
  }

  static function getRating(PDO $db, int $restaurantID) {
    $stmt = $db->prepare('SELECT round(avg(average),1) AS rating 
                          FROM (SELECT username, avg(score) AS average 
                                FROM review 
                                WHERE restaurantID=? 
                                GROUP BY username)');
    $stmt->execute(array($restaurantID));
    return  $stmt->fetch()['rating'];
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