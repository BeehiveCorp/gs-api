<?php

// Database
require_once "./database/Database.php";

// Core
require_once "./core/Request.php";
require_once "./core/Router.php";

// Utilities
require_once "./utils/ResponseErrorHandler.php";

// Main
require_once "./models/index.php";
require_once "./repositories/index.php";
require_once "./controllers/index.php";

// Routes
require_once "./routes.php";