<?php
require_once("Model.php");

class User extends Model
{
    private int $id;
    private string $username;
    private string $email;
    private string $password;
    private string $phone_nbr;

    protected static string $table = "users";

    public function __construct(array $data)
    {
        $this->id = $data["id"];
        $this->username = $data["username"];
        $this->email = $data["email"];
        $this->password = $data["password"];
        $this->phone_nbr = $data["phone_nbr"];
    }

    public static function findByEmailOrPhone(mysqli $db, string $identifier): ?User {
        $query = $db->prepare("SELECT * FROM users WHERE email = ? OR phone_nbr = ?");
        $query->bind_param("ss", $identifier, $identifier);
        $query->execute();
        $data = $query->get_result()->fetch_assoc();
        return $data ? new User($data) : null;
    }

    public static function hashPassword(string $password): string {
        return password_hash($password, PASSWORD_DEFAULT);
    }

    public function verifyPassword(string $password): bool {
        return password_verify($password, $this->password);
    }

    public static function create(mysqli $db, string $username, string $email, string $phone_nbr, string $password): bool {
        $hashedPassword = self::hashPassword($password);
        $data = [
            'username' => $username,
            'email' => $email,
            'phone_nbr' => $phone_nbr,
            'password' => $hashedPassword
        ];
        return self::insert($db, $data);  
    }

    public function getId(): int { return $this->id; }
    public function getUsername(): string { return $this->username; }
    public function getEmail(): string { return $this->email; }
    public function getPhoneNbr(): string { return $this->phone_nbr; }
    public function getPassword(): string { return $this->password; }

    public function setUsername(string $username): void { $this->username = $username; }
    public function setEmail(string $email): void { $this->email = $email; }
    public function setPassword(string $password): void { $this->password = $password; }
    public function setPhoneNbr(string $phone): void { $this->phone_nbr = $phone; }

    public function toArray(): array {
        return [
            'id' => $this->id,
            'username' => $this->username,
            'email' => $this->email,
            'phone_nbr' => $this->phone_nbr,
            'password' => $this->password
        ];
    }
}
