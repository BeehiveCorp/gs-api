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
    $sql = 'INSERT INTO ' . self::$table . ' (dependent_id, user_id, exam_date, exam_local)
      VALUES (?, ?, ?, ?)';
    
    $stmt = self::$pdoConn->prepare($sql);

    $stmt->execute([
      $exam->getDependentId(),
      $exam->getUserId(),
      $exam->getExamDate(),
      $exam->getExamLocal(),
    ]);

    return $stmt->rowCount() > 0;
  }
}