<?php

class ExamNutrientModel{

  private $nutrient_id;
  private $exam_id;
  private $result;

  function __construct(array $data) {
    $this->nutrient_id = $data["nutrient_id"] ?? null;
    $this->exam_id = $data["exam_id"] ?? null;
    $this->result = $data["result"] ?? null;
  }

  public function getNutrientId() {
    return $this->nutrient_id;
  }

  public function getExamId() {
    return $this->exam_id;
  }

  public function getResult() {
    return $this->result;
  }
}