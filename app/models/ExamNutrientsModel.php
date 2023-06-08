<?php

class ExamNutrientsModel{

  private $exam_id;
  private $nutrient_id;
  private $result;

  function __construct(stdClass $data) {
    $this->exam_id = $data->exam_id ?? null;
    $this->nutrient_id = $data->nutrient_id ?? null;
    $this->result = $data->result ?? null;
  }
//acho que é pq a tabela exam tem que ter o campo nutrient)id
  public function getExamId() {
    return $this->exam_id;
  }

  public function getNutrientId() {
    return $this->nutrient_id;
  }

  public function getResult() {
    return $this->result;
  }

  public function getJsonSerialized() {
    return [
      'exam_id' => $this->exam_id,
      'nutrient_id' => $this->nutrient_id,
      'result' => $this->result,
    ];
  }
}