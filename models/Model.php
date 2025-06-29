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

    // ✅ Reusable Insert Method
    public static function insert(mysqli $db, array $data): bool {
        $columns = implode(", ", array_keys($data));
        $placeholders = implode(", ", array_fill(0, count($data), "?"));

        $sql = "INSERT INTO " . static::$table . " ($columns) VALUES ($placeholders)";
        $stmt = $db->prepare($sql);
        if (!$stmt) return false;

        $types = self::getTypes($data);
        $stmt->bind_param($types, ...array_values($data));

        return $stmt->execute();
    }

    // ✅ Reusable Update Method
    public static function update(mysqli $db, int $id, array $data): bool {
        $fields = implode(", ", array_map(fn($key) => "$key = ?", array_keys($data)));

        $sql = "UPDATE " . static::$table . " SET $fields WHERE " . static::$primary_key . " = ?";
        $stmt = $db->prepare($sql);
        if (!$stmt) return false;

        $types = self::getTypes($data) . "i";
        $stmt->bind_param($types, ...array_merge(array_values($data), [$id]));

        return $stmt->execute();
    }

    // ✅ Utility to Auto-Detect Bind Param Types
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
