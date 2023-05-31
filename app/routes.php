<?php

$router = new Router(new Request());

$router->get('/users', [$UserController, 'getAllUsers']);
