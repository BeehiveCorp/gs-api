<?php

class NutrientRepository {
  static private $pdoConn = null;
  static private $table = "NUTRIENTS";

  function __construct(Database $database) {
    self::$pdoConn = $database->getConnection();
  }

  static function all() {
    $sql = 'SELECT * FROM ' . self::$table;
    $stmt = self::$pdoConn->prepare($sql);
    
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public static function findOneBy($column, $condition): ?NutrientModel {
    $sql = 'SELECT * FROM ' . self::$table . ' WHERE ' . $column . ' = ' . "'{$condition}'";
    $stmt = self::$pdoConn->prepare($sql);
      
    $stmt->execute();
  
    $result = $stmt->fetchObject();
    
    return $result ? new NutrientModel($result) : null;
  }
}