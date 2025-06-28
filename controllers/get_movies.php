<?php
require_once '../connections/database.php';
require_once '../models/Movie.php';

header('Content-Type: application/json');
date_default_timezone_set('UTC');
$today = date('Y-m-d');

$sql = "SELECT id, title, photo AS poster, rating, release_date, genre, cast, cast_photo FROM movies ORDER BY release_date DESC";
$result = $mysqli->query($sql);

$nowShowing = [];
$comingSoon = [];

if ($result) {
    while ($row = $result->fetch_assoc()) {

        if ($row['release_date'] <= $today) {
            $nowShowing[] = $row;
        } else {
            $comingSoon[] = $row;
        }
    }

    echo json_encode([
        'success' => true,
        'nowShowing' => $nowShowing,
        'comingSoon' => $comingSoon,
        'suggested' => []
    ]);
} else {
    echo json_encode(['success' => false, 'message' => $mysqli->error]);
}
?>
