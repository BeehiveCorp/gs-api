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

  public function createDependent(Request $request) {
    $body = $request->body;

    $dependent = new DependentModel($body);

    $wasInserted = $this->DependentRepository::insert($dependent);

    if (!$wasInserted) {
        ResponseHandler::error(422, "Algo deu errado.");
    }
    ResponseHandler::success(201);
}


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

public function deleteDependent($id) {
  $existingDependent = $this->DependentRepository->findById($id);

  if (!$existingDependent) {
      ResponseHandler::error(404, "Dependente não encontrado.");
  }

  $wasDeleted = $this->DependentRepository->delete($id);

  if (!$wasDeleted) {
      ResponseHandler::error(500, "Não foi possível excluir o dependente.");
  }

  ResponseHandler::success(200);
}



}
