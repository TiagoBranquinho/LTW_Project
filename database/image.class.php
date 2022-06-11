<?php
  declare(strict_types = 1);
  include_once('utils.php');
  include_once('database/connection.db.php');

  class Image {
    public int $id;
    public string $path;

    public function __construct(string $path) {
      $this->path = $path;
    }

      /**
       * @return int
       */
      public function getId(): int
      {
          return $this->id;
      }

      /**
       * @param int $id
       */
      public function setId(int $id): void
      {
          $this->id = $id;
      }

      /**
       * @return string
       */
      public function getPath(): string
      {
          return $this->path;
      }

      /**
       * @param string $path
       */
      public function setPath(string $path): void
      {
          $this->path = $path;
      }
    

    static function getImage(PDO $db, int $id) : Image {
      $stmt = $db->prepare('SELECT imageID, Path FROM Image WHERE imageID = ?');
      $stmt->execute(array($id));
  
      $image = $stmt->fetch();

      $imageObject = new Image($image['Path']);
      $imageObject->setId($id);

      return $imageObject;
    }  
  }
?>