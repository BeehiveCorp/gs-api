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
    echo json_encode($errorResponse);
    exit;
  }

  public static function success($statusCode = 200, $data = null) {
    // sleep(1);
    http_response_code($statusCode);
    header('Content-Type: application/json');
    echo json_encode($data);
    exit;
  }
}
