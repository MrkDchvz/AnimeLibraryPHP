<?php 
// Create a new PDO and connect to database
$pdo = new PDO('mysql:host=localhost;port=3306;dbname=myapp', 'root', '');
// Set PDO attribute for error handling
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

return $pdo;