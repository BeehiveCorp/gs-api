<?php

class PregnancyController {

  private $PregnancyRepository;

  function __construct() {
    $database = new Database("database", "nutriaapp", "root", "nutriaapp");
    $connection = $database->getConnection();

    $this->PregnancyRepository = new PregnancyRepository($connection);
  }

  public function getAll() {
    $all = $this->PregnancyRepository::all();
    ResponseHandler::success(200, $all);
  }

  public function createPregnancy(Request $request){
    $body = $request->body;

    $pregnancy = new PregnancyModel($body);

    $wasInserted = $this->PregnancyRepository::insert($pregnancy);

    if (!$wasInserted) {
        ResponseHandler::error(422, "Algo deu errado.");
    }
    ResponseHandler::success(201);
  }

}