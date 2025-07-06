<?php
require_once '../connections/database.php';
require_once '../models/User.php';
require_once '../services/ResponseService.php'; 

header("Content-Type: application/json");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    register();
}

function register(): void {
    $input = json_decode(file_get_contents("php://input"), true);

    $username   = trim($input['username'] ?? '');
    $email      = trim($input['email'] ?? '');
    $phone_nbr  = trim($input['phone_nbr'] ?? '');
    $password   = $input['password'] ?? '';

    if (!$username || !$email || !$phone_nbr || !$password) {
        ResponseService::error_response('All fields are required', 400);
        return;
    }

    global $mysqli;
    $success = User::create($mysqli, $username, $email, $phone_nbr, $password);

    if ($success) {
        ResponseService::success_response([
            'message' => 'Registration successful'
        ]);
    } else {
        ResponseService::error_response('Registration failed', 500);
    }
}
