<?php

class PregnancyModel {
  static private $pdoConn = null;
  static private $table = "PREGNANCIES";

  function __construct(Database $database) {
    self::$pdoConn = $database->getConnection();
  }

  static function all() {
    $sql = 'SELECT * FROM ' . self::$table;
    $stmt = self::$pdoConn->prepare($sql);
    
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }
}