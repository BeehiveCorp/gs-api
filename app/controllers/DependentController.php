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

  public function updateDependent(Request $request, $id){
    $body = $request->body;
    $dependent = new DependentModel($body);

    $nameExist = $this->DependentRepository::findOneBy('name', $dependent->getName());

    if ($nameExist && $nameExist->getId() !== $id) {
        ResponseHandler::error(400, "Dependente com o mesmo nome já existe.");
    }

    $wasUpdated = $this->DependentRepository::update($id, $dependent);

    if (!$wasUpdated) {
        ResponseHandler::error(422, "Não foi possível atualizar o dependente.");
    }
    ResponseHandler::success(200);
}


}
