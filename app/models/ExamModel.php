<?php

class ExamModel{

  private $dependent_id;
  private $user_id;
  private $exam_date;
  private $exam_local;

  function __construct(stdClass $data) {
    $this->dependent_id = $data->dependent_id ?? null;
    $this->user_id = $data->user_id ?? null;
    $this->exam_date = $data->exam_date ?? null;
    $this->exam_local = $data->exam_local ?? null;
  }

  public function getDependentId() {
    return $this->dependent_id;
  }

  public function getUserId() {
    return $this->user_id;
  }

  public function getExamDate() {
    return $this->exam_date;
  }

  public function getExamLocal() {
    return $this->exam_local;
  }

  public function getJsonSerialized() {
    return [
      'dependent_id' => $this->dependent_id,
      'risk-user_id' => $this->user_id,
      'exam_date' => $this->exam_date,
      'exam_local' => $this->exam_local
    ];
  }


}