<?php

require_once "./controllers/UserController.php";
require_once "./controllers/DependentController.php";
require_once "./controllers/ExamController.php";
require_once "./controllers/PregnancyController.php";
require_once "./controllers/ExamNutrientController.php";



$UserController = new UserController();
$DependentController = new DependentController();
$ExamController = new ExamController();
$PregnancyController = new PregnancyController();
$ExamNutrientController = new ExamNutrientController();