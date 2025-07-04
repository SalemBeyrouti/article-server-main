<?php

require("../connection/connection.php");

$query = "ALTER TABLE articles
        Add COLUMN category_id INT,
        ADD CONSTRAINT fk_category
        FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE SET NULL";

$execute = $mysqli->prepare($query);
$execute->execute();