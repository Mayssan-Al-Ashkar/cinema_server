<?php
require_once '../connections/database.php';
require_once '../models/UserPreference.php';

header('Content-Type: application/json');

$method = $_SERVER['REQUEST_METHOD'];

if ($method === 'GET') {
    $userId = $_GET['user_id'] ?? null;
    if ($userId) {
        $data = UserPreference::findByUserId($mysqli, intval($userId));
        echo json_encode(['success' => true, 'data' => $data]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error']);
    }
}

if ($method === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);
    $userId = $input['user_id'] ?? null;

    if ($userId) {
        $result = UserPreference::insert_update($mysqli, $userId, $input);

        if ($result) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'Database operation failed.',
                'mysqli_error' => $mysqli->error 
            ]);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Error']);
    }
}

?>  