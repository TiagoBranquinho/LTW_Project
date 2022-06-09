<?php
  declare(strict_types = 1);

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
  }
?>