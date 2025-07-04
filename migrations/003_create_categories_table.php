<?php 
require("../connection/connection.php");


$query = "CREATE TABLE categories(
          id INT AUTO_INCREMENT PRIMARY KEY, 
          name VARCHAR(255) NOT NULL, 
          created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP, 
          updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP)";

$execute = $mysqli->prepare($query);
$execute->execute();