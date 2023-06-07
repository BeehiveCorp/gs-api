<?php

class ExamRepository {
  static private $pdoConn = null;
  static private $table = "EXAMS";

  function __construct(Database $database) {
    self::$pdoConn = $database->getConnection();
  }

  static function all() {
    $sql = 'SELECT * FROM ' . self::$table;
    $stmt = self::$pdoConn->prepare($sql);
    
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  static function insert(ExamModel $exam) {
    $sql = 'INSERT INTO ' . self::$table . ' (dependent_id, user_id, date, local)
      VALUES (?, ?, ?, ?)';
    
    $stmt = self::$pdoConn->prepare($sql);

    $stmt->execute([
      $exam->getDependentId(),
      $exam->getUserId(),
      $exam->getDate(),
      $exam->getLocal(),
    ]);

    return $stmt->rowCount() > 0;
  }

  public static function where($conditions): array {
    $sql = 'SELECT * FROM ' . self::$table . ' WHERE ' . $conditions . 'ORDER BY date DESC';
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