<?php
  declare(strict_types = 1);

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

    static function registerUser(PDO $db, string $username, string $password, string $email, string $address, string $phoneNumber, bool $restaurantOwner, bool $customer) {
      $stmt = $db->prepare('SELECT count(*) FROM User WHERE username = ?');
      $stmt->execute(array($username));
      $userCount = $stmt->fetch();
      if(userCount) return false;

      $stmt = $db->prepare('INSERT INTO User VALUES(?,?,?,?,?,?,?)');
      $stmt->execute(array($username, sha1($password), $email, $address, $phoneNumber, $restaurantOwner, $customer));
      return true;
    }
  }
?>