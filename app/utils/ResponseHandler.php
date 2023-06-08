<?php

class ResponseHandler {
  public static function error($statusCode, $errorMessage) {
    // sleep(1);
    http_response_code($statusCode);
    $errorResponse = [
      'error' => [
        'code' => $statusCode,
        'message' => $errorMessage
      ]
    ];
    header('Content-Type: application/json');
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: GET, POST');
    header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token , Authorization');
    header("Access-Control-Max-Age", 3600);
    echo json_encode($errorResponse);
    exit;
  }

  public static function success($statusCode = 200, $data = null) {
    // sleep(1);
    http_response_code($statusCode);
    header('Content-Type: application/json');
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: GET, POST');
    header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token , Authorization');
    header("Access-Control-Max-Age", 3600);
    echo json_encode($data);
    exit;
  }
}
