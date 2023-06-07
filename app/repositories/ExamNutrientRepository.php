<?php

class ExamNutrientRepository {
  static private $pdoConn = null;
  static private $table = "EXAM_NUTRIENTS";

  function __construct(Database $database) {
    self::$pdoConn = $database->getConnection();
  }

  static function all() {
    $sql = 'SELECT * FROM ' . self::$table;
    $stmt = self::$pdoConn->prepare($sql);
    
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  static function insert(ExamNutrientModel $examNutrient) {
    $sql = 'INSERT INTO ' . self::$table . ' (nutrient_id, exam_id, result)
      VALUES (?, ?, ?)';
    
    $stmt = self::$pdoConn->prepare($sql);

    $stmt->execute([
      $examNutrient->getNutrientId(),
      $examNutrient->getExamId(),
      $examNutrient->getResult(),
    ]);

    return $stmt->rowCount() > 0 ? self::$pdoConn->lastInsertId() : false;
  }

  public static function where($conditions): array {
    $sql = 'SELECT * FROM ' . self::$table . ' WHERE ' . $conditions;
    $stmt = self::$pdoConn->prepare($sql);
      
    $stmt->execute();
  
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  
  public static function sql($query): array {
    $stmt = self::$pdoConn->prepare($query);
      
    $stmt->execute();
  
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }
}