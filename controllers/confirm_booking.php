<?php
require_once '../connections/database.php';
require_once '../models/Booking.php';

$data = json_decode(file_get_contents('php://input'), true);
$userId = $data['user_id'];
$movieId = $data['movie_id'];
$seats = $data['seats'];

if (!$userId || !$movieId || empty($seats)) {
    echo json_encode(['success' => false, 'message' => 'Missing required data']);
    exit;
}

Booking::reserveSeats($mysqli, $userId, $movieId, $seats);
echo json_encode(['success' => true]);
