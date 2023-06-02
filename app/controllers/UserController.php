<?php

class UserController {
  private $UserRepository;
  private $PregnancyRepository;

  function __construct() {
    $database = new Database("database", "nutriaapp", "root", "nutriaapp");
    $connection = $database->getConnection();

    $this->UserRepository = new UserRepository($connection);
    $this->PregnancyRepository = new PregnancyRepository($connection);
  }

  public function getAll() {
    $all = $this->UserRepository::all();
    ResponseHandler::success(200, $all);
  }

  public function create(Request $request) {
    $body = $request->body;

    $user = new UserModel($body);

    $isEmailInUse = $this->UserRepository::findOneBy('email', $user->getEmail());

    if ($isEmailInUse) ResponseHandler::error(400, "Endereço de e-mail em uso.");

    $wasInserted = $this->UserRepository::insert($user);

    if (!$wasInserted) ResponseHandler::error(422, "Algo deu errado.");

    if ($body->is_pregnant) {
      $insertedUser = $this->UserRepository::findOneBy('email', $user->getEmail());
  
      $pregnancy = new PregnancyModel(null, $body->weeks, $body->risk_pregnant, $insertedUser);

      $wasPregnancyInserted = $this->PregnancyRepository::insert($pregnancy);

      if (!$wasPregnancyInserted) ResponseHandler::error(422, "Algo deu errado.");
    }

    ResponseHandler::success(201);
  }
}