<?php
require_once '../connections/database.php';

$sql = "CREATE TABLE IF NOT EXISTS bookings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    movie_id INT NOT NULL,
    seat_id VARCHAR(10) NOT NULL,
    seat_type ENUM('normal', 'premium') NOT NULL,
    status ENUM('reserved', 'cancelled') DEFAULT 'reserved',

CONSTRAINT fk_user FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    CONSTRAINT fk_movie FOREIGN KEY (movie_id) REFERENCES movies(id) ON DELETE CASCADE



);";

if ($mysqli->query($sql)) {
    echo "created successfully";
} else {
    echo "Error";
}
?>