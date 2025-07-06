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
    
    public function getUserId(): int { return $this->user_id; }
    public function getFullName(): string { return $this->full_name; }
    public function getAge(): int { return $this->age; }
    public function getGender(): string { return $this->gender; }
    public function getLocation(): string { return $this->location; }
    public function getFavoriteGenre(): string { return $this->favorite_genre; }
    public function getPaymentMethod(): string { return $this->payment_method; }
    public function getCommunicationPref(): string { return $this->communication_pref; }

    public function setFullName(string $full_name): void { $this->full_name = $full_name; }
    public function setAge(int $age): void { $this->age = $age; }
    public function setGender(string $gender): void { $this->gender = $gender; }
    public function setLocation(string $location): void { $this->location = $location; }
    public function setFavoriteGenre(string $favorite_genre): void { $this->favorite_genre = $favorite_genre; }
    public function setPaymentMethod(string $payment_method): void { $this->payment_method = $payment_method; }
    public function setCommunicationPref(string $communication_pref): void { $this->communication_pref = $communication_pref; }

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
}
