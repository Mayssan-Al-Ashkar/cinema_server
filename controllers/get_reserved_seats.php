<?php
require_once '../connections/database.php';
require_once '../models/Booking.php';

$movieId = $_GET['movie_id'] ?? null;

if (!$movieId) {
    echo json_encode(['success' => false, 'message' => 'Movie ID is required']);
    exit;
}

$seats = Booking::getReservedSeats($mysqli, $movieId);
echo json_encode(['success' => true, 'reserved_seats' => $seats]);
