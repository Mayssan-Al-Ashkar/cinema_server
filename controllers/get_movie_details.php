<?php
require_once '../connections/database.php';
require_once '../models/movie_details.php';

header('Content-Type: application/json');

if (!isset($_GET['id'])) {
    echo json_encode(['success' => false, 'message' => 'Movie ID is required']);
    exit;
}

$id = intval($_GET['id']);
$movie = MovieDetails::find($mysqli, $id);

if ($movie) {
    echo json_encode(['success' => true, 'movie' => $movie->toArray()]);
} else {
    echo json_encode(['success' => false, 'message' => 'Movie not found']);
}
?>
