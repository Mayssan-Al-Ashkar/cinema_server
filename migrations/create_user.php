<?php
require_once '../connections/database.php';

$sql = "CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) NOT NULL,
    phone_nbr VARCHAR(100) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
)";

if ($mysqli->query($sql) === TRUE) {
    echo "done";
} else {
    echo "Error ";
}
?>
