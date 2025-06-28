<?php
require_once '../connections/database.php';

$movies = [
    [
        "title" => "fall boy",
        "description" => "An epic journey across unknown lands.",
        "genre" => "Adventure",
        "rating" => 8.2,
        "release_date" => "2025-7-3",
        "photo" => "http://localhost/Cinema/cinema-server/uploads/movie1.png",
        "cast" => "John Smith,Alberto Tuno",
        "cast_photo" => "http://localhost/Cinema/cinema-server/uploads/movie3_cast.jpeg"
    ],
    [
        "title" => "The watch",
        "description" => "A thrilling voyage through the galaxy.",
        "genre" => "Sci-Fi",
        "rating" => 9.0,
        "release_date" => "2025-6-30",
        "photo" => "http://localhost/Cinema/cinema-server/uploads/movie2.png",
        "cast" => "Emily Johnson,Robert snek",
        "cast_photo" => "http://localhost/Cinema/cinema-server/uploads/movie2_cast.jpeg"
    ],
    [
        "title" => "paddington",
        "description" => "Secrets hidden in a tropical paradise.",
        "genre" => "Mystery",
        "rating" => 7.5,
        "release_date" => "2025-6-29",
        "photo" => "http://localhost/Cinema/cinema-server/uploads/movie3.png",
        "cast" => "David Lee, Leyan Johenson",
        "cast_photo" => "http://localhost/Cinema/cinema-server/uploads/movie1_cast.jpeg"
    ],
];

foreach ($movies as $movie) {
    $query = $mysqli->prepare("INSERT INTO movies (title, description, genre, rating, release_date, photo, cast, cast_photo) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $query->bind_param(
        "sssdssss",
        $movie['title'],
        $movie['description'],
        $movie['genre'],
        $movie['rating'],
        $movie['release_date'],
        $movie['photo'],
        $movie['cast'],
        $movie['cast_photo']
    );

    if ($query->execute()) {
        echo " added successfully";
    } else {
        echo " Error";
    }

    $query->close();
}

$mysqli->close();
?>
