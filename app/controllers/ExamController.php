<?php

class ExamController {

  private $ExamRepository;

  function __construct() {
    $database = new Database("database", "nutriaapp", "root", "nutriaapp");
    $database->getConnection();

    $this->ExamRepository = new ExamRepository($database);
  }

  public function getAllByUserId($userId) {
    $exams = $this->ExamRepository::where('user_id = ' . "'$userId'");
    ResponseHandler::success(200, $exams);
  }

  public function getAllByDependentId($dependentId) {
    $exams = $this->ExamRepository::where('dependent_id = ' . "'$dependentId'");
    ResponseHandler::success(200, $exams);
  }

  public function getAllByUserOrDependentId($params) {
    if (isset($params->userId)) $this->getAllByUserId($params->userId);
    else if (isset($params->dependentId)) $this->getAllByDependentId($params->dependentId);
    else ResponseHandler::error(404, "Query param não esperada");
  }


  public function getAll(Request $request) {
    $id = $request->params;

    if ($id) {
      $this->getAllByUserOrDependentId($id);
      return;
    }

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

  public function getById(Request $request) {
    $sql = 'SELECT date, local, name, description, symbol, result FROM EXAMS e
                INNER JOIN EXAM_NUTRIENTS en
                ON e.id = en.exam_id
                    INNER JOIN NUTRIENTS n
                    ON en.nutrient_id = n.id
                        WHERE e.id = ' . $request->params->id;

    $results = $this->ExamRepository::sql($sql);

    if (count($results) === 0) {
      ResponseHandler::error(404, "Nada encontrado");
    }

    $examDate = $results[0]["date"];
    $examLocal = $results[0]["local"];

    $examNutrientsResults = [];

    foreach ($results as $result) {
      $examNutrientsResults[] = [
        "name" => $result["name"],
        "description" => $result["description"],
        "symbol" => $result["symbol"],
        "result" => $result["result"],
      ];
    }

    ResponseHandler::success(200, [
      "date" => $examDate,
      "local" => $examLocal,
      "nutrients" => $examNutrientsResults
    ]);
  }
}