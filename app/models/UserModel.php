<?php

class UserModel {
  private $id;
  private $name;
  private $birth_date;
  private $gender;
  private $weight;
  private $height;
  private $email;
  private $password;
  private $avatar;
  
  function __construct(stdClass $data) {
    $this->id = $data->id ?? null;
    $this->name = $data->name ?? null;
    $this->birth_date = $data->birth_date ?? null;
    $this->gender = $data->gender ?? null;
    $this->weight = $data->weight ?? null;
    $this->height = $data->height ?? null;
    $this->email = $data->email ?? null;
    $this->password = $data->password ?? null;
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

  public function getEmail() {
    return $this->email;
  }
  
  public function getPassword() {
    return $this->password;
  }
  
  public function getAvatar() {
    return $this->avatar;
  }

  public function getJsonSerialized() {
    return [
      'id' => $this->id,
      'name' => $this->name,
      'birth_date' => $this->birth_date,
      'gender' => $this->gender,
      'weight' => $this->weight,
      'height' => $this->height,
      'email' => $this->email,
      'password' => $this->password,
      'avatar' => $this->avatar
    ];
  }
}