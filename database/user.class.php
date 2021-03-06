<?php
  declare(strict_types = 1);
  include_once('database/connection.db.php');

  class User {
    public string $username;
    public string $email;
    public string $address;
    public string $phoneNumber;

    public function __construct(string $username, string $email, string $address, string $phoneNumber)
    { 
      $this->username = $username;
      $this->email = $email;
      $this->address = $address;
      $this->phoneNumber = $phoneNumber;
    }

    function getPassword(PDO $db)
    {
        $stmt = $db->prepare('SELECT password from user where username = ?');
        $stmt->execute([$this->username]);
        $pass = $stmt->fetch();
        return $pass['password'];
    }

    static function setRestaurantAsFavourite(PDO $db, string $username, int $restaurantID) {
        $stmt = $db->prepare('INSERT INTO FavouriteRestaurant VALUES(?, ?)');
        $stmt->execute([$restaurantID,$username]);
    }

      static function checkIfRestaurantAsFavourite(PDO $db, string $username, int $restaurantID): bool {
          $stmt = $db->prepare('SELECT * FROM FavouriteRestaurant WHERE restaurantID = ? AND username = ?');
          $stmt->execute([$restaurantID,$username]);

          if($stmt->fetch()) return true;

          return false;
      }


      static function removeRestaurantAsFavourite(PDO $db, string $username, int $restaurantID) {
          $stmt = $db->prepare('DELETE FROM FavouriteRestaurant WHERE restaurantID = ? AND username = ?');
          $stmt->execute([$restaurantID,$username]);
      }

    static function getCustomer(string $username) {
        $db = getDatabaseConnection();
        $stmt = $db->prepare('SELECT username FROM Customer WHERE username = ?');
        $stmt->execute([$username]);
        return $stmt->fetch();
    }

    public function changePass(PDO $db, string $newPass){
      $stmt = $db->prepare("UPDATE User SET password = ? WHERE username = ?");
      $stmt->execute([$newPass, $this->username]);
    }

    static function getUserWithPassword(PDO $db, string $username, string $password){
        $stmt = $db->prepare('SELECT * FROM User WHERE lower(username) = ? AND password = ?');
        $stmt->execute(array(strtolower($username), sha1($password)));
    
        if ($user = $stmt->fetch()){
            return new User(
                $user['username'],
                $user['email'],
                $user['address'],
                $user['phoneNumber']
            );
        }
        else return null;
    }

    static function getUser(PDO $db, string $username){
      $stmt = $db->prepare('SELECT * FROM User WHERE lower(username) = ?');
      $stmt->execute(array(strtolower($username)));

      if ($user = $stmt->fetch()){
          return new User(
              $user['username'],
              $user['email'],
              $user['address'],
              $user['phoneNumber'],
          );
      }
      else return null;
  }

    static function registerUser(PDO $db, string $username, string $password, string $email, string $address, string $phoneNumber) {
      $stmt = $db->prepare("SELECT * FROM User WHERE username = ?");
      $stmt->execute([$username]);
      $user = $stmt->fetch();

      if($user){
          return false;
      }
      else{
        echo "conta disponivel";
        $stmt = $db->prepare('INSERT INTO User VALUES(?,?,?,?,?)');
        $stmt->execute(array($username, sha1($password), $email, $address, $phoneNumber));
        $stmt = $db->prepare('INSERT INTO Customer VALUES(?)');
        $stmt->execute([$username]);
        return true;
      }
    }

    static function editUser(PDO $db, User $user) {
      $stmt = $db->prepare("UPDATE User SET email = ?, address = ?, phoneNumber = ? WHERE user.username = ?");
      $stmt->execute([$user->email, $user->address, $user->phoneNumber, $user->username]);
    }
  }
?>