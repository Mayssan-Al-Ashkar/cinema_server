<?php
require_once "Model.php";

class Movie extends Model
{
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


    public function __construct(array $data)
    {
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

    public function getId(): int {
        return $this->id;
    }

    public function getTitle(): string {
        return $this->title;
    }

    public function getDescription(): string {
        return $this->description;
    }

    public function getGenre(): string {
        return $this->genre;
    }

    public function getRating(): float {
        return $this->rating;
    }

    public function getReleaseDate(): string {
        return $this->release_date;
    }

    public function getPhoto(): string {
        return $this->photo;
    }
    public function getCast(): string {
        return $this->cast;
    }

    public function getCastPhoto(): string {
        return $this->cast_photo;
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

//     public static function getGroupedMovies(mysqli $mysqli): array {
//     $today = date('Y-m-d');

//     $sql = "SELECT id, title, photo AS poster, rating, release_date, genre, cast, cast_photo FROM movies ORDER BY release_date DESC";
//     $result = $mysqli->query($sql);

//     $nowShowing = [];
//     $comingSoon = [];

//     if ($result) {
//         while ($row = $result->fetch_assoc()) {
//             if ($row['release_date'] <= $today) {
//                 $nowShowing[] = $row;
//             } else {
//                 $comingSoon[] = $row;
//             }
//         }
//     }

//     return [
//         'nowShowing' => $nowShowing,
//         'comingSoon' => $comingSoon,
//         'suggested' => [] 
//     ];
// }

}
?>
