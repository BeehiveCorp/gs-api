<?php

class DependentRepository {
  static private $pdoConn = null;
  static private $table = "DEPENDENTS";

  
  function __construct(PDO $connection) {
    self::$pdoConn = $connection;
  }

  static function all() {
    $sql = 'SELECT * FROM ' . self::$table;
    $stmt = self::$pdoConn->prepare($sql);
    
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  static function insert(DependentModel $dependent): bool {
    $sql = 'INSERT INTO ' . self::$table . ' (name, gender, weight, height,  birth_date, avatar)
      VALUES (?, ?, ?, ?, ?, ?, ?, ?)';
    
    $stmt = self::$pdoConn->prepare($sql);

    $stmt->execute([
      $dependent->getName(),
      $dependent->getGender(),
      $dependent->getWeight(),
      $dependent->getHeight(),
      $dependent->getBirthDate(),
      $dependent->getAvatar()
    ]);

    return $stmt->rowCount() > 0;
  }

  public static function findOneBy($column, $condition): ?DependentModel {
    $sql = 'SELECT * FROM ' . self::$table . ' WHERE ' . $column . ' = ' . "'{$condition}'";

    $stmt = self::$pdoConn->prepare($sql);
      
    $stmt->execute();
  
    $result = $stmt->fetchObject();
    
    return $result ? new DependentModel($result) : null;
  }

  public static function update($id, DependentModel $dependent) {
    $name = $dependent->getName();
    $birthDate = $dependent->getBirthDate();
    $gender = $dependent->getGender();
    $avatar = $dependent->getAvatar();
    $height = $dependent->getHeight();
    $weight = $dependent->getWeight();

    $sql = "UPDATE dependentes SET name=?, birth_date=?, gender=?, avatar=?, height=?, weight=? WHERE id=?";
    $stmt = self::$pdoConn->prepare($sql);
    $stmt->execute([$name, $birthDate, $gender, $avatar, $height, $weight, $id]);

    return $stmt->rowCount() > 0;
}

}