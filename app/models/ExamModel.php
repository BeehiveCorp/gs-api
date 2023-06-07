<?php

class ExamModel{

  private $dependent_id;
  private $user_id;
  private $date;
  private $local;

  function __construct(stdClass $data) {
    $this->dependent_id = $data->dependent_id ?? null;
    $this->user_id = $data->user_id ?? null;
    $this->date = $data->date ?? null;
    $this->local = $data->local ?? null;
  }

  public function getDependentId() {
    return $this->dependent_id;
  }

  public function getUserId() {
    return $this->user_id;
  }

  public function getDate() {
    return $this->date;
  }

  public function getLocal() {
    return $this->local;
  }

  public function getJsonSerialized() {
    return [
      'dependent_id' => $this->dependent_id,
      'risk-user_id' => $this->user_id,
      'date' => $this->date,
      'local' => $this->local
    ];
  }


}