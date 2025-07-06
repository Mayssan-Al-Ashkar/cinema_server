<?php
require_once '../connections/database.php';
require_once '../models/User.php';
require_once '../services/ResponseService.php'; 

header("Content-Type: application/json");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    login();
}

function login(): void {
    $input = json_decode(file_get_contents("php://input"), true);

    $identifier = trim($input['email'] ?? ''); 
    $password   = $input['password'] ?? '';

    if (!$identifier || !$password) {
        ResponseService::error_response('Email/phone number and password are required', 400);
        return;
    }

    global $mysqli;
    $user = User::findByEmailOrPhone($mysqli, $identifier);

    if ($user && $user->verifyPassword($password)) {
        session_start();
        $_SESSION['user_id'] = $user->getId();
        $_SESSION['username'] = $user->getUsername();

        ResponseService::success_response([
            "message"  => "Login successful!",
            "username" => $user->getUsername(),
            "user_id"  => $user->getId()
        ]);
    } else {
        ResponseService::error_response("Invalid credentials", 401);
    }
}
