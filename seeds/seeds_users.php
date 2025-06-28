<?php
require_once '../connections/database.php'; 

$users = [
    ['Ahmad', '0123456789', 'ahmad@gmail.com', '123456'],
    ['Sara', '0987654321', 'sara@gmail.com', 'password123'],
    ['Mayssan', '7654321098', 'mayssan@gmail.com', '43253']
];

foreach ($users as $user) {
    $username = $user[0];
    $phone_nbr = $user[1];
    $email = $user[2];
    $hashedPassword = password_hash($user[3], PASSWORD_DEFAULT);

    $query = $mysqli->prepare("INSERT INTO users (username, phone_nbr, email, password) VALUES (?, ?, ?, ?)");
    $query->bind_param("ssss", $username, $phone_nbr, $email, $hashedPassword);
    
    if ($query->execute()) {
        echo " added successfully";
    } else {
        echo "Error";
    }

    $query->close();
}

$mysqli->close();
?>
