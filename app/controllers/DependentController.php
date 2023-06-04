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
  //crud

  public function createDependent(Request $request){
    $body = $request->body;
    $dependent = new DependentModel($body);

    $nameExist = $this->DependentRepository::findOneBy('id', $dependent->getName());

    if ($nameExist) {
      ResponseHandler::error(400, "Dependente já existe.");
    }

    $wasInserted = $this->DependentRepository::insert($dependent);

    if (!$wasInserted) {
        ResponseHandler::error(422, "Algo deu errado.");
    }
    ResponseHandler::success(201);
}
}
