<?php

class ExamController {

  private $ExamRepository;

  function __construct() {
    $database = new Database("database", "nutriaapp", "root", "nutriaapp");
    $database->getConnection();

    $this->ExamRepository = new ExamRepository($database);
  }

  public function getAll() {
    $all = $this->ExamRepository::all();
    ResponseHandler::success(200, $all);
  }

  public function createExam(Request $request) {
    $body = $request->body;

    $exam = new ExamModel($body);

    $wasInserted = $this->ExamRepository::insert($exam);

    if (!$wasInserted) {
        ResponseHandler::error(422, "Algo deu errado.");
    }
    ResponseHandler::success(201);
}

}