<?php

class UserRepository {
  static private $pdoConn = null;
  static private $table = "USERS";

  function __construct(PDO $connection) {
    self::$pdoConn = $connection;
  }

  static function all() {
    $sql = 'SELECT * FROM ' . self::$table;
    $stmt = self::$pdoConn->prepare($sql);
    
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  static function insert(UserModel $user): bool {
    $sql = 'INSERT INTO ' . self::$table . ' (name, email, gender, weight, height, password, birth_date, avatar)
      VALUES (?, ?, ?, ?, ?, ?, ?, ?)';
    
    $stmt = self::$pdoConn->prepare($sql);

    $stmt->execute([
      $user->getName(),
      $user->getEmail(),
      $user->getGender(),
      $user->getWeight(),
      $user->getHeight(),
      $user->getPassword(),
      $user->getBirthDate(),
      $user->getAvatar()
    ]);

    return $stmt->rowCount() > 0;
  }

  public static function where($conditions): array {
    $sql = 'SELECT * FROM ' . self::$table . ' WHERE ' . $conditions;
    $stmt = self::$pdoConn->prepare($sql);
      
    $stmt->execute();
  
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public static function findOneBy($column, $condition): ?UserModel {
    $sql = 'SELECT * FROM ' . self::$table . ' WHERE ' . $column . ' = ' . "'{$condition}'";
    $stmt = self::$pdoConn->prepare($sql);
      
    $stmt->execute();
  
    $result = $stmt->fetchObject();
    
    return $result ? new UserModel($result) : null;
  }
  
}