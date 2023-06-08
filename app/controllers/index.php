<?php

require_once "./controllers/UserController.php";
require_once "./controllers/DependentController.php";
require_once "./controllers/ExamController.php";
require_once "./controllers/PregnancyController.php";
require_once "./controllers/ProductController.php";
require_once "./controllers/StoreController.php";


$UserController = new UserController();
$DependentController = new DependentController();
$ExamController = new ExamController();
$PregnancyController = new PregnancyController();
$ProductController = new ProductController();
$StoreController = new StoreController();
