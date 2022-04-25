<?php
  declare(strict_types = 1);

  class Image {
    public int $id;
    public string $path;

    public function __construct(int $id, string $path)
    { 
      $this->id = $id;
      $this->path = $path;
    }

    

    static function getImage(PDO $db, int $id) : Image {
      $stmt = $db->prepare('SELECT ImageID, Path FROM Image, WHERE ImageID = ?');
      $stmt->execute(array($id));
  
      $image = $stmt->fetch();
  
      return new Image(
        $image['ImageID'], 
        $image['Path']
      );
    }  
  }
?>