<?php
require_once '../connections/database.php';
require_once '../models/Booking.php';
require_once '../services/ResponseService.php';

header('Content-Type: application/json');

reserveSeats();


function reserveSeats(): void {
    $data = json_decode(file_get_contents('php://input'), true);

    $userId  = $data['user_id'] ?? null;
    $movieId = $data['movie_id'] ?? null;
    $seats   = $data['seats'] ?? [];

    if (!$userId || !$movieId || empty($seats)) {
        ResponseService::error_response('Missing required data', 400);
        return;
    }

    global $mysqli;
    $success = Booking::reserveSeats($mysqli, $userId, $movieId, $seats);

    if ($success) {
        ResponseService::success_response(['message' => 'Seats reserved successfully']);
    } else {
        ResponseService::error_response('Failed to reserve seats', 500);
    }
}
