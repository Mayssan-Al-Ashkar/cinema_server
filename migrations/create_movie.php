<?php
require_once '../connections/database.php';

$sql = "CREATE TABLE IF NOT EXISTS movies (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    genre VARCHAR(100) NOT NULL,
    rating FLOAT NOT NULL,
    release_date DATE NOT NULL,
    photo VARCHAR(255) NOT NULL
)";

if ($mysqli->query($sql) === TRUE) {
    echo "done";
} else {
    echo "Error";
}
?>
