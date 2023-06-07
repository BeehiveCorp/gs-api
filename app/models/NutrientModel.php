<?php

class NutrientModel {
  private $id;
  private $name;
  private $description;  
  private $symbol;
  
  function __construct(stdClass $data) {
    $this->id = $data->id ?? null;
    $this->name = $data->name ?? null;
    $this->description = $data->description ?? null;
    $this->symbol = $data->symbol ?? null;
  }

  public function getId() {
    return $this->id;
  }

  public function getName() {
    return $this->name;
  }

  public function getSymbol() {
    return $this->symbol;
  }

  public function getDescription() {
    return $this->description;
  }
}