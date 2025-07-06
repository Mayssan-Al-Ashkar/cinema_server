<?php
require_once '../connections/database.php';
require_once '../models/User.php';

header("Content-Type: application/json");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = json_decode(file_get_contents("php://input"), true);

    $identifier = trim($input['email'] ?? ''); 
    $password = $input['password'] ?? '';

    if (!$identifier || !$password) {
        echo json_encode(['error' => 'email/phone number and password are required']);
        exit;
    }

    $user = User::findByEmailOrPhone($mysqli, $identifier);

    if ($user && $user->verifyPassword($password)) {
        session_start();
        $_SESSION['user_id'] = $user->getId();
        $_SESSION['username'] = $user->getUsername();

        echo json_encode([
            "success" => true,
            "message" => "Login successful!",
            "username" => $user->getUsername(),
            "user_id" => $user->getId()
        ]);
    } else {
        echo json_encode(["success" => false, "message" => "Invalid credential"]);
    }
}  


