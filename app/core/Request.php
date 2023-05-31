<?php

class Request {
  public $httpMethod = null;
  public $protocol = null;
  public $body = null;
  public $uri = null;
  public $params = null;

  function __construct() {
    $this->protocol = $_SERVER['SERVER_PROTOCOL'];
    $this->httpMethod = $_SERVER['REQUEST_METHOD'];
    $this->body = $this->getBody();
    $this->uri = $this->getParsedUri($_SERVER['REQUEST_URI']);
    $this->params = $this->getParsedParams($_SERVER['REQUEST_URI']);
  }

  private function getParsedUri($uri) {
    list($parsedUri) = explode("?", $uri) + [null];
    return $parsedUri;
  }

  private function getParsedParams($uri) {
    list($dummy, $params) = explode("?", $uri) + [null, null];

    if ($params) {
      parse_str($params, $parsedParams);

      $queryParamsObj = new stdClass();

      foreach ($parsedParams as $key => $value) {
        $queryParamsObj->$key = $value;
      }

      return $queryParamsObj;
    }
  }

  private function getBody() {
    $body = file_get_contents("php://input");
    $decodedBody = json_decode($body);

    return $decodedBody;
  }
}