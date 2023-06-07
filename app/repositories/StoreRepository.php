<?php

class StoreRepository {
  static private $pdoConn = null;
  static private $table = "STORES";

  function __construct(PDO $connection) {
    self::$pdoConn = $connection;
  }

  static function all() {
    $sql = 'SELECT * FROM ' . self::$table;
    $stmt = self::$pdoConn->prepare($sql);
    
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public static function where($conditions): array {
    $sql = 'SELECT * FROM ' . self::$table . ' WHERE ' . $conditions;
    $stmt = self::$pdoConn->prepare($sql);
      
    $stmt->execute();
  
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }
}