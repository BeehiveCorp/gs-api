<?php

$UserController = new UserController();

$router = new Router(new Request());

$router->get('/', function() {
  echo "GET DEU BOM";
});

$router->get('/users', [$UserController, 'getAllUsers']);

$router->get('/users/update/:id', function() {
  echo "UPDATING USERS";
});

$router->get('/cars/update', function() {
  echo "UPDATING CARS";
});

$router->put('/data', function($request) {
  return json_encode($request->body);
});