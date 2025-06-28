<?php
require_once '../connections/database.php';
require_once '../models/User.php';

header("Content-Type: application/json");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
 
    $input = json_decode(file_get_contents("php://input"), true);

    $username = trim($input['username'] ?? '');
    $email = trim($input['email'] ?? '');
    $phone_nbr = trim($input['phone_nbr'] ?? '');
    $password = $input['password'] ?? '';

    if (!$username || !$email || !$phone_nbr || !$password) {
        echo json_encode(['success' => false, 'message' => 'All fields are required']);
        exit;
    }

    $success = User::create($mysqli, $username, $email, $phone_nbr, $password);

    echo json_encode([
        'success' => $success,
        'message' => $success ? 'Registration successful' : 'Registration failed'
    ]);
}  
