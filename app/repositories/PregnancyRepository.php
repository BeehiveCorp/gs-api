<?php

class PregnancyRepository {
  static private $pdoConn = null;
  static private $table = "PREGNANCIES";

  function __construct(PDO $connection) {
    self::$pdoConn = $connection;
  }

  static function all() {
    $sql = 'SELECT * FROM ' . self::$table;
    $stmt = self::$pdoConn->prepare($sql);
    
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  static function insert(PregnancyModel $pregnancy): bool {
    $sql = 'INSERT INTO ' . self::$table . ' (user_id, weeks, risk_pregnant) VALUES (?, ?, ?)';

    $stmt = self::$pdoConn->prepare($sql);

    $stmt->execute([
      $pregnancy->getUser()->getId(),
      $pregnancy->getWeeks(),
      $pregnancy->isRiskPregnant(),
    ]);

    return $stmt->rowCount() > 0;
  }

  public static function where($conditions): array {
    $sql = 'SELECT * FROM ' . self::$table . ' WHERE ' . $conditions;
    $stmt = self::$pdoConn->prepare($sql);
      
    $stmt->execute();
  
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }
  
}