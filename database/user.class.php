<?php
  declare(strict_types = 1);
  include_once('database/connection.db.php');

  class User {
    public string $username;
    public string $email;
    public string $address;
    public string $phoneNumber;
    public bool $restaurantOwner;
    public bool $customer; 

    public function __construct(string $username, string $email, string $address, string $phoneNumber, bool $restaurantOwner, bool $customer)
    { 
      $this->username = $username;
      $this->email = $email;
      $this->address = $address;
      $this->phoneNumber = $phoneNumber;
      $this->restaurantOwner = $restaurantOwner;
      $this->customer = $customer;
    }
    
    function getPassword(PDO $db){
      $stmt = $db->prepare('SELECT password from user.password where username = ?');
      $stmt->execute([$username]);
      $pass = $stmt->fecth();
      return pass;
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
                $user['phoneNumber'],
                $user['restaurantOwner']?true:false,
                $user['customer']?true:false
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
              $user['restaurantOwner']?true:false,
              $user['customer']?true:false
          );
      }
      else return null;
  }

    static function registerUser(PDO $db, string $username, string $password, string $email, string $address, string $phoneNumber, bool $restaurantOwner, bool $customer) {
      $stmt = $db->prepare("SELECT * FROM user WHERE user.username = ?");
      $stmt->execute([$username]);
      $user = $stmt->fetch();

      if($user){
          return false;
      }
      else{
        echo "conta disponivel";
        $stmt = $db->prepare('INSERT INTO User VALUES(?,?,?,?,?,?,?)');
        $stmt->execute(array($username, sha1($password), $email, $address, $phoneNumber, $restaurantOwner?1:0, $customer?1:0));
        return true;
      }
    }

    static function editUser(PDO $db, User $user) {
      $stmt = $db->prepare("UPDATE User SET email = ?, address = ?, phoneNumber = ? WHERE user.username = ?");
      $stmt->execute([$user->email, $user->address, $user->phoneNumber, $user->username]);
    }
  }
?>