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

    // public static function find(mysqli $mysqli, int $id): ?self {
    //     $sql = "SELECT * FROM " . static::$table . " WHERE id = ?";
    //     $stmt = $mysqli->prepare($sql);
    //     $stmt->bind_param("i", $id);
    //     $stmt->execute();
    //     $result = $stmt->get_result();

    //     if ($data = $result->fetch_assoc()) {
    //         return new self($data);
    //     }

    //     return null;
    // }



  
    public function getId(): int { return $this->id; }
    public function getTitle(): string { return $this->title; }
    public function getDescription(): string { return $this->description; }
    public function getGenre(): string { return $this->genre; }
    public function getRating(): float { return $this->rating; }   
    public function getReleaseDate(): string { return $this->release_date; }
    public function getPhoto(): string { return $this->photo; }
    public function getCast(): string { return $this->cast; }
    public function getCastPhoto(): string { return $this->cast_photo; }


    public function setTitle(string $title): void { $this->title = $title; }
    public function setDescription(string $description): void { $this->description = $description; }
    public function setGenre(string $genre): void { $this->genre = $genre; }
    public function setRating(float $rating): void { $this->rating = $rating; }
    public function setReleaseDate(string $release_date): void { $this->release_date = $release_date; }
    public function setPhoto(string $photo): void { $this->photo = $photo; }
    public function setCast(string $cast): void { $this->cast = $cast; }
    public function setCastPhoto(string $cast_photo): void { $this->cast_photo = $cast_photo; }


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
