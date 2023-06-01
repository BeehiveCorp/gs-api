<?php

class UserController {
  private $User;

  function __construct() {
    $database = new Database("database", "nutriaapp", "root", "nutriaapp");
    $this->User = new UserModel($database);
  }

  public function getAllUsers($request) {
    $body = $request->body;
    $params = $request->params;

    $allUsers = $this->User::all();

    return json_encode($allUsers);
  }
}

class DepedentController {
  private $User;

  function __construct() {
    $database = new Database("database", "nutriaapp", "root", "nutriaapp");
    $this->User = new DependentsModel($database);
  }

  public function getAllUsers($request) {
    $body = $request->body;
    $params = $request->params;

    $allUsers = $this->User::all();

    return json_encode($allUsers);
  }
}