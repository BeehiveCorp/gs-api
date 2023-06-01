<?php

class Economic_establishmentsModel {
  static private $pdoConn = null;
  static private $table = "EXAMS_NUTRIENTS";

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