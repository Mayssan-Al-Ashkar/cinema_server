<?php
require_once "Model.php";

class MovieDetails extends Model {
    protected static string $table = "movies";

    private int $id;
    private string $title;
    private string $description;
    private string $genre;
    private float $rating;
    private string $release_date;
    private string $photo;
    private string $cast;
    private string $cast_photo;

    public function __construct(array $data) {
        $this->id = $data["id"];
        $this->title = $data["title"];
        $this->description = $data["description"];
        $this->genre = $data["genre"];
        $this->rating = floatval($data["rating"]);
        $this->release_date = $data["release_date"];
        $this->photo = $data["photo"];
        $this->cast = $data["cast"];
        $this->cast_photo = $data["cast_photo"];
    }

    public static function find(mysqli $mysqli, int $id): ?self {
        $sql = "SELECT * FROM " . static::$table . " WHERE id = ?";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($data = $result->fetch_assoc()) {
            return new self($data);
        }

        return null;
    }

    public function toArray(): array {
        return [
            "id" => $this->id,
            "title" => $this->title,
            "description" => $this->description,
            "genre" => $this->genre,
            "rating" => $this->rating,
            "release_date" => $this->release_date,
            "photo" => $this->photo,
            "cast" => $this->cast,
            "cast_photo" => $this->cast_photo,
        ];
    }
}
?>
