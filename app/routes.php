<?php

$router = new Router(new Request());

$router->get('/users', [$UserController, 'getAll']);
$router->get('/dependents', [$DependentsController, 'getAll']);
$router->get('/pregnancies', [$PregnanciesController, 'getAll']);
$router->get('/exams', [$ExamsController, 'getAll']);
$router->get('/stores', [$StoresController, 'getAll']);
$router->get('/exam_nutrients', [$Exam_nutrientsController, 'getAll']);
$router->get('/nutrients', [$NutrientsController, 'getAll']);
$router->get('/products', [$ProductsController, 'getAll']);
$router->get('/product_categories', [$Product_CategoriesController, 'getAll']);
$router->get('/product_categories_nutrients', [$Product_Categories_NutrientsController, 'getAll']);
$router->get('/economic_establishments', [$Economic_EstablishmentsController, 'getAll']);