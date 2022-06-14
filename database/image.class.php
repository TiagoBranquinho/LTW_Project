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

      static function getLastestImageID(PDO $db): int {
          $imgStmt = $db->prepare('SELECT imageID FROM Image ORDER BY imageID DESC LIMIT 1');
          $imgStmt->execute();
          $imageObj = $imgStmt->fetch();
          return $imageObj['imageID'];
      }

      static function getImage(PDO $db, int $id) : Image {
          $stmt = $db->prepare('SELECT imageID, Path FROM Image WHERE imageID = ?');
          $stmt->execute(array($id));

          $image = $stmt->fetch();

          $imageObject = new Image($image['path']);
          $imageObject->setId($id);

          return $imageObject;
      }

      static function replaceObjectImage(PDO $db, string $inputName, int $imageID, string $newRestaurantName) {
          $tempname = $_FILES[$inputName]['tmp_name'];
          $folder =  "img/restaurants/".$newRestaurantName."/".$newRestaurantName.".png";
          if(move_uploaded_file($tempname,$folder)) {
              ?> <script> alert('File uploaded!') </script> <?php
              $insertFilenameStmt = $db->prepare('UPDATE Image SET path = ? WHERE imageID = ?');
              $insertFilenameStmt->execute(array($folder, $imageID));
          } else {
              ?> <script> alert('File upload fail!') </script> <?php
          }
      }
  }
?>