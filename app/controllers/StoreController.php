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
}