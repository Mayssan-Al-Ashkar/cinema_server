<?php
require_once '../connections/database.php';
require_once '../models/movie_details.php';
require_once '../services/ResponseService.php';

header('Content-Type: application/json');

getMovieDetails();

function getMovieDetails(): void {
    $id = $_GET['id'] ?? null;

    if (!$id) {
        ResponseService::error_response('Movie ID is required', 400);
        return;
    }

    global $mysqli;
    $id = intval($id);
    $movie = MovieDetails::find($mysqli, $id);

    if ($movie) {
        ResponseService::success_response([
            'movie' => $movie->toArray()
        ]);
    } else {
        ResponseService::error_response('Movie not found', 404);
    }
}
