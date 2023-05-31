<?php

class Router {
  private $request;
  private $routes = array("GET" => [], "POST" => [], "DELETE" => [], "PATCH" => [], "PUT" => []);

  function __construct(Request $request) {
    $this->request = $request;
  }

  public function __call($routeHttpMethod, $rest) {
    list($route, $callback) = $rest;

    $this->routes[strtoupper($routeHttpMethod)][$route] = $callback;
  }


  private function resolve() {
    $requestHttpMethod = $this->request->httpMethod;
    $requestFormattedUri = $this->request->uri;

    $isRouteValid = array_key_exists($requestFormattedUri, $this->routes[$requestHttpMethod]);

    if (!$isRouteValid) {
      $this->defaultRequestHandler();
      return;
    }

    $callback = $this->routes[$requestHttpMethod][$requestFormattedUri];

    if(is_null($callback)) {
      $this->defaultRequestHandler();
      return;
    }

    echo call_user_func_array($callback, array($this->request));
  }

  private function defaultRequestHandler() {
    header("{$this->request->protocol} 404 Not Found");
  }

  function __destruct() {
    $this->resolve();
  }
}