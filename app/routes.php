<?php

$router = new Router(new Request());

// User routes
$router->get('/users/all', [$UserController, 'getAll']);
$router->post('/users/create', [$UserController, 'create']);
$router->post('/users/login', [$UserController, 'login']);

// Dependents routes
$router->post('/dependents/insert', [$DependentController, 'createDependent']);
$router->get('/dependents/all', [$DependentController, 'getAll']);
$router->put('/dependents/update', [$DependentController, 'updateDependent']);
$router->delete('/dependents/delete', [$DependentController, 'deleteDependent']);


$router->get('/pregnancies/all', [$PregnancyController, 'getAll']);
$router->get('/pregnancies/insert', [$PregnancyController, 'createPregnancy']);


$router->get('/exams/all', [$ExamController, 'getAll']);
$router->post('/exams/insert', [$ExamController, 'createExam']);

// $router->get('/stores', [$StoresController, 'getAll']);

// $router->get('/exam_nutrients', [$Exam_nutrientsController, 'getAll']);

// $router->get('/nutrients', [$NutrientsController, 'getAll']);

// $router->get('/products', [$ProductsController, 'getAll']);

// $router->get('/product_categories', [$Product_CategoriesController, 'getAll']);

// $router->get('/product_categories_nutrients', [$Product_Categories_NutrientsController, 'getAll']);

// $router->get('/economic_establishments', [$Economic_EstablishmentsController, 'getAll']);