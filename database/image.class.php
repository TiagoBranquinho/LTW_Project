<?php
  declare(strict_types = 1);
  include_once('utils.php');
  include_once('database/connection.db.php');

  class Image {
    public int $id;
    public string $path;

    public function __construct(string $path)
    { 
      $this->id = getCurrID(getDatabaseConnection(), "imageID", "Image");
      $this->path = $path;
    }

    

    static function getImage(PDO $db, int $id) : Image {
      $stmt = $db->prepare('SELECT imageID, Path FROM Image, WHERE imageID = ?');
      $stmt->execute(array($id));
  
      $image = $stmt->fetch();
  
      return new Image(
        $image['ImageID'], 
        $image['Path']
      );
    }  
  }
?>