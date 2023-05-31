<?php

class UserController {
  public function index($request) {
    $body = $request->body;
    $params = $request->params;

    return json_encode($params);
  }
}