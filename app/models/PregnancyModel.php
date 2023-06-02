<?php

class PregnancyModel {
  private $id;
  private $weeks;
  private $riskPregnant;
  private $user;

  function __construct(?string $id, int $weeks, bool $riskPregnant, UserModel $user) {
    $this->id = $id;
    $this->weeks = $weeks;
    $this->riskPregnant = $riskPregnant;
    $this->user = $user;
  }

  public function getId() {
    return $this->id;
  }

  public function getWeeks() {
    return $this->weeks;
  }

  public function isRiskPregnant() {
    return $this->riskPregnant ? 1 : 0;
  }

  public function getUser() {
    return $this->user;
  }

  public function getJsonSerialized() {
    return [
      'weeks' => $this->weeks,
      'risk-pregnant' => $this->riskPregnant,
      'user' => $this->user->getJsonSerialized()
    ];
  }
}
