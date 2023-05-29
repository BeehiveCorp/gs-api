<?php

$host = "database";
$username = "root";
$password = "nutriaapp";
$db = "nutriaapp";

try {
    $conn = new PDO("mysql:host=$host;dbname=$db", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "<h2>Connected<h2>";
} catch(PDOException $e) {
    echo 'ERROR: ' . $e->getMessage();
}
