<?php

class UserController {
  private $User;

  function __construct() {
    $this->User = new UserModel();
  }

  public function getAllUsers($request) {
    $body = $request->body;
    $params = $request->params;

    $allUsers = $this->User::all();

    echo $allUsers;
  }
}