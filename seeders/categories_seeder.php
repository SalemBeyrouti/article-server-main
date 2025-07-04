<?php 
require("../connection/connection.php");

$categories = ["Technology","Education", "Travel", "Cooking", "Music"];

foreach ($categories as $cat) {
    $stmt = $mysqli->prepare("INSERT INTO categories (name) VALUES (?)");
   $stmt->bind_param("s", $cat);
   $stmt->execute(); 
}

