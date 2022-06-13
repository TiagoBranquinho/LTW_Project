<?php
  declare(strict_types = 1);
  include_once('database/connection.db.php');
  include_once('database/utils.php');

  class Order {
    public int $orderID;
    public string $state;
    public int $restaurantID;
    public int $dishID;
    public int $quantity;
    public string $username;

    public function __construct(int $orderID, string $state, int $restaurantID, int $dishID, int $quantity, string $username)
    {
      if($orderID === 0)
        $this->orderID = getCurrID(getDatabaseConnection(), "orderID", "Orders");
      else
        $this->orderID = $orderID;
      $this->state = $state;
      $this->restaurantID = $restaurantID;
      $this->dishID = $dishID;
      $this->quantity = $quantity;
      $this->username = $username;
    }

  
static function filterOrders(array &$orderList, string $filter) {
  $newArr = array();
  if($filter != "All"){
    foreach($orderList as $order){
      if($order->state === $filter)
          array_push($newArr, $order);
    }
    $orderList = $newArr;
  }
}
static function getUserOrders(PDO $db, string $username) {
  $stmt = $db->prepare('SELECT * FROM Orders where username = ?');
  $stmt->execute(array($username));

  $orders = array();
  while($order = $stmt->fetch()){
      $thisOrder = new Order(
          $order['orderID'],
          $order['state'],
          $order['restaurantID'],
          $order['dishID'],
          $order['quantity'],
          $order['username']
      );
      array_push($orders, $thisOrder);
  }
  return $orders;
}

static function getOrdersStates(PDO $db) {
  $stmt = $db->prepare('SELECT kind FROM OrderState ORDER BY kind ASC');
  $stmt->execute();

  $states = array();
  while($state = $stmt->fetch()){
      array_push($states, $state);
  }
  return $states;
}

static function getOrder(PDO $db) {
  $stmt = $db->prepare('SELECT * FROM Restaurant');
  $stmt->execute();

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

static function registerOrder(PDO $db, Order $order) {;
  $stmt = $db->prepare('INSERT INTO Orders VALUES(?,?,?,?,?,?)');
  $stmt->execute(array($order->orderID, $order->state, $order->restaurantID, $order->dishID, $order->quantity, $order->username));
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