<?php

class PregnancyModel {
  private $id;
  private $weeks;
  private $riskPregnancy;
  private $user;

  function __construct(?string $id, int $weeks, bool $riskPregnancy, UserModel $user) {
    $this->id = $id;
    $this->weeks = $weeks;
    $this->riskPregnancy = $riskPregnancy;
    $this->user = $user;
  }

  public function getId() {
    return $this->id;
  }

  public function getWeeks() {
    return $this->weeks;
  }

  public function isRiskPregnancy() {
    return $this->riskPregnancy ? 1 : 0;
  }

  public function getUser() {
    return $this->user;
  }

  public function getJsonSerialized() {
    return [
      'weeks' => $this->weeks,
      'risk-pregnant' => $this->riskPregnancy,
      'user' => $this->user->getJsonSerialized()
    ];
  }
}
