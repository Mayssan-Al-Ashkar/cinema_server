<?php
require_once '../connections/database.php';
require_once '../models/UserPreference.php';
require_once '../services/ResponseService.php';

header('Content-Type: application/json');

$method = $_SERVER['REQUEST_METHOD'];

if ($method === 'GET') {
    getUserPreference();
} elseif ($method === 'POST') {
    saveUserPreference();
}

function getUserPreference(): void {
    $userId = $_GET['user_id'] ?? null;

    if (!$userId) {
        ResponseService::error_response('User ID is required', 400);
        return;
    }

    global $mysqli;
    $data = UserPreference::find($mysqli, intval($userId));
    ResponseService::success_response(['data' => $data]);
}

function saveUserPreference(): void {
    $input = json_decode(file_get_contents('php://input'), true);
    $user_id = $input['user_id'] ?? null;

    if (!$user_id) {
        ResponseService::error_response('User ID is required', 400);
        return;
    }

    global $mysqli;
    $user_id = intval($user_id);
    $input['user_id'] = $user_id;

    $existing = UserPreference::find($mysqli, $user_id);

    if ($existing) {
        updateUserPreference($mysqli, $user_id, $input);
    } else {
        insertUserPreference($mysqli, $input);
    }
}

function insertUserPreference(mysqli $mysqli, array $input): void {
    $result = UserPreference::insert($mysqli, $input);

    if ($result) {
        ResponseService::success_response(['message' => 'Inserted successfully']);
    } else {
        ResponseService::error_response('Insert failed: ' . $mysqli->error, 500);
    }
}

function updateUserPreference(mysqli $mysqli, int $user_id, array $input): void {
    $result = UserPreference::update($mysqli, $user_id, $input);

    if ($result) {
        ResponseService::success_response(['message' => 'Updated successfully']);
    } else {
        ResponseService::error_response('Update failed: ' . $mysqli->error, 500);
    }
}
