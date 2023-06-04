<?php

class DependentController {

  private $DependentRepository;

  function __construct() {
    $database = new Database("database", "nutriaapp", "root", "nutriaapp");
    $connection = $database->getConnection();

    $this->DependentRepository = new DependentRepository($connection);
  }

  public function getAll() {
    $all = $this->DependentRepository::all();
    ResponseHandler::success(200, $all);
  }


}