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

  static function insert(ExamNutrientsModel $examN) {
    $sql = 'INSERT INTO ' . self::$table . ' (exam_id, nutrient_id, result)
      VALUES (?, ?, ?)';
    
    $stmt = self::$pdoConn->prepare($sql);

    $stmt->execute([
      $examN->getExamId(),
      $examN->getNutrientId(),
      $examN->getResult(),
    ]);

    return $stmt->rowCount() > 0;
  }
}