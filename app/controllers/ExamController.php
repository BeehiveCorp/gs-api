<?php

class ExamController {

  private $ExamRepository;
  private $ExamNutrientRepository;
  private $NutrientRepository;
  
  function __construct() {
    $database = new Database("database", "nutriaapp", "root", "nutriaapp");
    $connection = $database->getConnection();

    $this->ExamRepository = new ExamRepository($connection);
    $this->ExamNutrientRepository = new ExamNutrientRepository($connection);
    $this->NutrientRepository = new NutrientRepository($connection);
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

    $insertedExamId = $this->ExamRepository::insert($exam);

    if (!$insertedExamId) {
      ResponseHandler::error(422, "Algo deu errado.");
    }

    $nutrients = $body->nutrients;

    foreach($nutrients as $n) {
      $nutrient = $this->NutrientRepository::findOneBy('symbol', $n->symbol);
      $nutrientId = $nutrient->getId();

      if ($nutrientId !== null) {
        $examNutrient = new ExamNutrientModel([
          "exam_id" => intval($insertedExamId),
          "nutrient_id" => $nutrientId,
          "result" => $n->result
        ]);

        $this->ExamNutrientRepository::insert($examNutrient);
      }
    }

    ResponseHandler::success(201);
  }

  public function getById(Request $request) {
    $sql = 'SELECT n.id, date, local, name, description, symbol, result FROM EXAMS e
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
        "id" => $result["id"],
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