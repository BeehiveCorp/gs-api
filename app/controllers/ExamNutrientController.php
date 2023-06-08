<?php

class ExamNutrientController {

  private $ExamNutrientRepository;

  function __construct() {
    $database = new Database("database", "nutriaapp", "root", "nutriaapp");
    $database->getConnection();

    $this->ExamNutrientRepository = new ExamNutrientRepository($database);
  }

  public function getAll() {
    $all = $this->ExamNutrientRepository::all();
    ResponseHandler::success(200, $all);
  }

  public function createExamNutrient(Request $request) {
    $body = $request->body;

    $exam = new ExamNutrientsModel($body);

    $wasInserted = $this->ExamNutrientRepository::insert($exam);

    if (!$wasInserted) {
        ResponseHandler::error(422, "Algo deu errado.");
    }
    ResponseHandler::success(201);
}
}