<?php
require_once 'Model.php';

class Booking extends Model {
    protected static string $table = 'bookings';

    public static function reserveSeats($mysqli, $userId, $movieId, $seats) {
        $stmt = $mysqli->prepare("INSERT INTO bookings (user_id, movie_id, seat_id, seat_type) VALUES (?, ?, ?, ?)");
        foreach ($seats as $seat) {
            $stmt->bind_param("iiss", $userId, $movieId, $seat['id'], $seat['type']);
            $stmt->execute();
        }
        return true;
    }

    public static function getReservedSeats($mysqli, $movieId) {
        $stmt = $mysqli->prepare("SELECT seat_id FROM bookings WHERE movie_id = ? AND status = 'reserved'");
        $stmt->bind_param("i", $movieId);
        $stmt->execute();
        $result = $stmt->get_result();

        $seats = [];
        while ($row = $result->fetch_assoc()) {
            $seats[] = $row['seat_id'];
        }
        return $seats;
    }
}
