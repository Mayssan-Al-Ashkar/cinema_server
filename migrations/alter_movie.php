<?php
require_once '../connections/database.php';

$sql = "ALTER TABLE movies 
        ADD COLUMN cast VARCHAR(255) NOT NULL,
        ADD COLUMN cast_photo VARCHAR(255) NOT NULL";

if ($mysqli->query($sql) === TRUE) {
    echo "done";
} else {
    echo "error ";
}
?>
