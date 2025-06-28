<?php
require_once '../connections/database.php';

$sql = "
CREATE TABLE IF NOT EXISTS user_preferences (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    full_name VARCHAR(100),
    age INT,
    gender ENUM('Male', 'Female', 'Other'),
    location VARCHAR(100),
    favorite_genre VARCHAR(100),
    payment_method ENUM('Cash', 'Card', 'Other'),
    communication_pref VARCHAR(100),
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);
";

if ($mysqli->query($sql)) {
    echo "done";
} else {
    echo "Eerror ";
}
?>
