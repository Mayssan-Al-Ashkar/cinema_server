<?php
require_once '../connections/database.php';
require_once '../models/Booking.php';
require_once '../services/ResponseService.php';

header('Content-Type: application/json');

getReservedSeats();

function getReservedSeats(): void {
    $movieId = $_GET['movie_id'] ?? null;

    if (!$movieId) {
        ResponseService::error_response('Movie ID is required', 400);
        return;
    }

    global $mysqli;
    $seats = Booking::getReservedSeats($mysqli, $movieId);

    ResponseService::success_response([
        'reserved_seats' => $seats
    ]);
}
