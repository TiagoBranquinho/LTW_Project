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
static function getUserOrders(PDO $db, string $username, string $favourite) {

  if($favourite === "off"){
    $querry = 'SELECT orderID, state, restaurantID, min(dishID) as min_dish, quantity, username
    FROM Orders
    WHERE Orders.username = ?
    group by orderID';
  }
  else{
    $querry = 'SELECT orderID, state, Orders.restaurantID, min(dishID) as min_dish, quantity, Orders.username
    FROM Orders
    INNER JOIN FavouriteRestaurant ON Orders.restaurantID=FavouriteRestaurant.restaurantID
    WHERE Orders.username = ?';
  }
  $stmt = $db->prepare($querry);
  $stmt->execute(array($username));

  $orders = array();
  while($order = $stmt->fetch()){
      $thisOrder = new Order(
          $order['orderID'],
          $order['state'],
          $order['restaurantID'],
          $order['min_dish'],
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

static function getOrders(PDO $db, int $id) {
  $stmt = $db->prepare('SELECT * FROM Orders WHERE orderID = ?');
  $stmt->execute(array($id));

  $orders = array();
  while($order = $stmt->fetch()){
    array_push($orders, new Order(
      $order['orderID'],
      $order['state'],
      $order['restaurantID'],
      $order['dishID'],
      $order['quantity'],
      $order['username']));
  }
  return $orders;
}

static function getOrderDishQuantity(PDO $db, int $orderID, int $dishID) {
  $stmt = $db->prepare('SELECT Orders.quantity as quant 
  FROM Orders, Dish 
  WHERE Orders.orderID = ? and Orders.dishID = Dish.dishID and Orders.dishID = ?');
  $stmt->execute(array($orderID, $dishID));

  $quantity = $stmt->fetch();
  return $quantity['quant'];
}

static function getOrderDishes(PDO $db, int $id, string $username) {
  $stmt = $db->prepare('SELECT Dish.dishID, Dish.name, Dish.imageID, Dish.restaurantID, Dish.price, Dish.category, Dish.discount
  FROM Dish, Orders
  WHERE Orders.orderID = ? and Orders.dishID = Dish.dishID and Orders.username = ?');
  $stmt->execute(array($id, $username));

  $dishes = array();
  while($dish = $stmt->fetch()){
    $thisDish = new Dish(
      $dish['name'],
      $dish['restaurantID'],
      $dish['price'],
      $dish['category'],
      $dish['discount']);
      $thisDish->dishID = $dish['dishID'];
      $thisDish->imageID = $dish['imageID'];
      array_push($dishes, $thisDish);
  }
  return $dishes;
}

static function getOrderPrice(PDO $db, int $id) {
  $stmt = $db->prepare('SELECT dishID, quantity from Orders WHERE orderID = ?');
  $stmt->execute(array($id));

  $dishes = array();
  while($dish = $stmt->fetch()){
    array_push($dishes, array($dish['dishID'], $dish['quantity']));
  }
  $sum = 0;
  foreach($dishes as $dish){
    $sum += (Dish::getDish(getDatabaseConnection(), $dish[0])->price * $dish[1]);
  }
  return $sum;
}

static function getNumDishes(PDO $db, int $id) {
  $stmt = $db->prepare('SELECT SUM(quantity) as value_sum FROM Orders WHERE orderID = ?');
  $stmt->execute(array($id));

  $value = $stmt->fetch();
  return $value['value_sum'];
  
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