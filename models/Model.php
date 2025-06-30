<?php
abstract class Model
{
    protected static string $table;
    protected static string $primary_key = 'id';

    public static function find(mysqli $mysqli, int $id) {
        $sql = sprintf("SELECT * FROM %s WHERE %s = ?", 
                        static::$table, 
                        static::$primary_key);
        
        $query = $mysqli->prepare($sql);
        $query->bind_param("i", $id);
        $query->execute();

        $data = $query->get_result()->fetch_assoc();
        return $data ? new static($data) : null;
    }

  
    public static function insert(mysqli $mysqli, array $data): bool {
        $columns = implode(", ", array_keys($data));
        $placeholders = implode(", ", array_fill(0, count($data), "?"));

        $sql = "INSERT INTO " . static::$table . " ($columns) VALUES ($placeholders)";
        $query = $mysqli->prepare($sql);
        if (!$query) return false;

        $types = self::getTypes($data);
        $query->bind_param($types, ...array_values($data));

        return $query->execute();
    }

 
    public static function update(mysqli $mysqli, int $id, array $data): bool {
        $fields = implode(", ", array_map(fn($key) => "$key = ?", array_keys($data)));

        $sql = "UPDATE " . static::$table . " SET $fields WHERE " . static::$primary_key . " = ?";
        $query = $mysqli->prepare($sql);
        if (!$query) return false;

        $types = self::getTypes($data) . "i";
        $query->bind_param($types, ...array_merge(array_values($data), [$id]));

        return $query->execute();
    }

    private static function getTypes(array $data): string {
        $types = "";
        foreach ($data as $value) {
            $types .= match (gettype($value)) {
                'integer' => 'i',
                'double'  => 'd',
                'string'  => 's',
                default   => 's'
            };
        }
        return $types;
    }
}
