<?php
  declare(strict_types = 1);

  function getCurrID(PDO $db, string $parameter, string $table){
    $stmt = $db->prepare("SELECT " . "Max(" . $parameter . ") as ret FROM " . $table);
    $stmt->execute();
    return $stmt->fetch()['ret'] + 1;
}

?>
    