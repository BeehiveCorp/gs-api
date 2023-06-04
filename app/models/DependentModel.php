<?php

class DependentModel {
  private $id;
  private $user_id;
  private $name;  
  private $birth_date;
  private $gender;
  private $avatar;
  private $height;
  private $weight;
  
  function __construct(stdClass $data) {
    $this->id = $data->id ?? null;
    $this->user_id = $data->id ?? null;
    $this->name = $data->name ?? null;
    $this->birth_date = $data->birth_date ?? null;
    $this->gender = $data->gender ?? null;
    $this->weight = $data->weight ?? null;
    $this->height = $data->height ?? null;
    $this->avatar = $data->avatar ?? null;
  }

  public function getId() {
    return $this->id;
  }

  public function getName() {
    return $this->name;
  }

  public function getBirthDate() {
    return $this->birth_date;
  }

  public function getGender() {
    return $this->gender;
  }

  public function getWeight() {
    return $this->weight;
  }

  public function getHeight() {
    return $this->height;
  }
 
  public function getAvatar() {
    return $this->avatar;
  }

  public function getJsonSerialized() {
    return [
      'id' => $this->id,
      'user_id' => $this->user_id,
      'name' => $this->name,
      'birth_date' => $this->birth_date,
      'gender' => $this->gender,
      'weight' => $this->weight,
      'height' => $this->height,
      'avatar' => $this->avatar
    ];
  }
}