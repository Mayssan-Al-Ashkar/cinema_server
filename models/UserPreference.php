<?php

require_once 'Model.php';

class UserPreference extends Model
{
    protected static string $table = 'user_preferences';
    protected static string $primary_key = 'user_id'; 

    private int $user_id;
    private string $full_name;
    private int $age;
    private string $gender;
    private string $location;
    private string $favorite_genre;
    private string $payment_method;
    private string $communication_pref;

    public function __construct(array $data)
    {
        $this->user_id = $data['user_id'];
        $this->full_name = $data['full_name'];
        $this->age = $data['age'];
        $this->gender = $data['gender'];
        $this->location = $data['location'];
        $this->favorite_genre = $data['favorite_genre'];
        $this->payment_method = $data['payment_method'];
        $this->communication_pref= $data['communication_pref'];
    }

    public function toArray(): array
    {
        return [
            'user_id' => $this->user_id,
            'full_name' => $this->full_name,
            'age' => $this->age,
            'gender' => $this->gender,
            'location' => $this->location,
            'favorite_genre' => $this->favorite_genre,
            'payment_method' => $this->payment_method,
            'communication_pref' => $this->communication_pref,
        ];
    }

    public static function updatePreferences(mysqli $mysqli, int $user_id, array $data): bool
    {
        $sql = "UPDATE " . static::$table . " SET
                    full_name = ?, 
                    age = ?, 
                    gender = ?, 
                    location = ?, 
                    favorite_genre = ?, 
                    payment_method = ?, 
                    communication_pref = ?
                WHERE user_id = ?";

        $query = $mysqli->prepare($sql);
        $query->bind_param(
            "sisssssi",
            $data['full_name'],
            $data['age'],
            $data['gender'],
            $data['location'],
            $data['favorite_genre'],
            $data['payment_method'],
            $data['communication_pref'],
            $user_id
        );

        return $query->execute();
    }

    public static function insertPreferences(mysqli $mysqli, int $user_id, array $data): bool
{
    $sql = "INSERT INTO " . static::$table . " 
            (user_id, full_name, age, gender, location, favorite_genre, payment_method, communication_pref)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

    $query = $mysqli->prepare($sql);

    if (!$query) {
        echo "error ";
        return false;
    }

    $query->bind_param(
        "isisssss",
        $user_id,
        $data['full_name'],
        $data['age'],
        $data['gender'],
        $data['location'],
        $data['favorite_genre'],
        $data['payment_method'],
        $data['communication_pref']
    );

    return $query->execute();
}



    public static function insert_update(mysqli $mysqli, int $user_id, array $data): bool
{
    $sql = "SELECT COUNT(*) as count FROM " . static::$table . " WHERE user_id = ?";
    $query = $mysqli->prepare($sql);
    $query->bind_param("i", $user_id);
    $query->execute();
    $result = $query->get_result()->fetch_assoc();

    if ($result && $result['count'] > 0) {
        return static::updatePreferences($mysqli, $user_id, $data);
    } else {
        return static::insertPreferences($mysqli, $user_id, $data);
    }
}

}  