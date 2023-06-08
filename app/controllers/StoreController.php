<?php

class StoreController {
  private $StoreRepository;

  function __construct() {
    $database = new Database("database", "nutriaapp", "root", "nutriaapp");
    $connection = $database->getConnection();

    $this->StoreRepository = new StoreRepository($connection);
  }

  public function getAll() {
    $all = $this->StoreRepository::all();
    ResponseHandler::success(200, $all);
  }

  public function getById(Request $request) {
    $params = $request->params;
    $id = $params->id;

    $store = $this->StoreRepository::where('id = ' . "'{$id}'");
    ResponseHandler::success(200, $store[0]);
  }

  public function login(Request $request) {
    $body = $request->body;

    $email = $body->email;
    $password = $body->password;

    $queryCondition = 'email = ' . "'$email'" . 'AND' . ' password = ' . "'$password'";
    $users = $this->StoreRepository::where($queryCondition);

    if (isset($users[0])) {
      ResponseHandler::success(200, $users[0]);
    }

    ResponseHandler::error(404, "Loja não encontrada");
  }

}