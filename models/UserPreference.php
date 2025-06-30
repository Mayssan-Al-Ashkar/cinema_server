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
        $this->communication_pref = $data['communication_pref'];
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

  
    public static function insertOrUpdate(mysqli $mysqli, int $user_id, array $data): bool {
        $existing = self::find($mysqli, $user_id);
        $data['user_id'] = $user_id;

        if ($existing) {
            return self::update($mysqli, $user_id, $data);
        } else {
            return self::insert($mysqli, $data);
        }
    }
}
