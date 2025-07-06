<?php
require_once '../connections/database.php';
require_once '../models/UserPreference.php';


header('Content-Type: application/json');

$method = $_SERVER['REQUEST_METHOD'];

if ($method === 'GET') {
    $userId = $_GET['user_id'] ?? null;
    if ($userId) {
        $data = UserPreference::find($mysqli, intval($userId));
        echo json_encode(['success' => true, 'data' => $data]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error']);
    }
}

if ($method === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);
    $user_id = $input['user_id'] ?? null;

    if ($user_id) {
        $user_id = intval($user_id);

        
        $existing = UserPreference::find($mysqli, $user_id);
        $input['user_id'] = $user_id;

        if ($existing) {
            $result = UserPreference::update($mysqli, $user_id, $input);
        } else {
            $result = UserPreference::insert($mysqli, $input);
        }

        echo json_encode([
            'success' => $result,
            'message' => $result ? 'Operation successful' : 'Database operation failed',
            'mysqli_error' => $result ? null : $mysqli->error
        ]);
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'User ID is required'
        ]);
    }

}
?>
