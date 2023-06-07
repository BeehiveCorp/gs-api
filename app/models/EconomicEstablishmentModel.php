<?php

class EconomicEstablishmentModel {
  private $id;
  private $address;
  private $number;
  private $is_paid;
  private $latitude;
  private $longitude;
  private $city;

  function __construct(?string $id, string $address, bool $riskPregnant, UserModel $user) {
    $this->id = $id;
    $this->address = $address;
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
