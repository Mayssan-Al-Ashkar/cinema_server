<?php
require_once 'Model.php';

class Booking extends Model {
    protected static string $table = 'bookings';

    private int $id;
    private int $user_id;
    private int $movie_id;
    private string $seat_id;
    private string $seat_type;
    private string $status;

    public function __construct(array $data) {
        $this->id = $data['id'] ?? 0;
        $this->user_id = $data['user_id'];
        $this->movie_id = $data['movie_id'];
        $this->seat_id = $data['seat_id'];
        $this->seat_type = $data['seat_type'];
        $this->status = $data['status'] ?? 'reserved';
    }

    public function getId(): int { return $this->id; }
    public function getUserId(): int { return $this->user_id; }
    public function getMovieId(): int { return $this->movie_id; }
    public function getSeatId(): string { return $this->seat_id; }
    public function getSeatType(): string { return $this->seat_type; }
    public function getStatus(): string { return $this->status; }

    public function setUserId(int $user_id): void { $this->user_id = $user_id; }
    public function setMovieId(int $movie_id): void { $this->movie_id = $movie_id; }
    public function setSeatId(string $seat_id): void { $this->seat_id = $seat_id; }
    public function setSeatType(string $seat_type): void { $this->seat_type = $seat_type; }
    public function setStatus(string $status): void { $this->status = $status; }

    public static function reserveSeats($mysqli, $userId, $movieId, $seats) {
        $query = $mysqli->prepare("INSERT INTO bookings (user_id, movie_id, seat_id, seat_type) VALUES (?, ?, ?, ?)");
        foreach ($seats as $seat) {
            $query->bind_param("iiss", $userId, $movieId, $seat['id'], $seat['type']);
            $query->execute();
        }
        return true;
    }

    public static function getReservedSeats($mysqli, $movieId) {
        $query = $mysqli->prepare("SELECT seat_id FROM bookings WHERE movie_id = ? AND status = 'reserved'");
        $query->bind_param("i", $movieId);
        $query->execute();
        $result = $query->get_result();

        $seats = [];
        while ($row = $result->fetch_assoc()) {
            $seats[] = $row['seat_id'];
        }
        return $seats;
    }
}
