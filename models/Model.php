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


    
}
/*
  
    public static function create(mysqli $mysqli, array $data): ?static {
        $obj = new static($data);
        return $obj->insert($mysqli) ? $obj : null;
    }


    public function insert(mysqli $mysqli): bool {
        $data = $this->toArray();
        $columns = implode(", ", array_keys($data));
        $placeholders = implode(", ", array_fill(0, count($data), '?'));

        $sql = "INSERT INTO " . static::$table . " ($columns) VALUES ($placeholders)";
        $query = $mysqli->prepare($sql);

        $types = '';
        $values = [];

        foreach ($data as $value) {
            if (is_int($value)) $types .= 'i';
            elseif (is_float($value)) $types .= 'd';
            else $types .= 's';

            $values[] = $value;
        }

        $query->bind_param($types, ...$values);
        return $query->execute();
    }

   
    public function update(mysqli $mysqli): bool {
        $data = $this->toArray();
        $primaryKey = static::$primary_key;
        $id = $data[$primaryKey];
        unset($data[$primaryKey]);

        $setClause = implode(", ", array_map(fn($key) => "$key = ?", array_keys($data)));
        $sql = "UPDATE " . static::$table . " SET $setClause WHERE $primaryKey = ?";

        $stmt = $mysqli->prepare($sql);

        $types = '';
        $values = [];

        foreach ($data as $value) {
            if (is_int($value)) $types .= 'i';
            elseif (is_float($value)) $types .= 'd';
            else $types .= 's';
            $values[] = $value;
        }

        $types .= 'i'; 
        $values[] = $id;

        $stmt->bind_param($types, ...$values);
        return $stmt->execute();
    }


    public function delete(mysqli $mysqli): bool {
        $primaryKey = static::$primary_key;
        $id = $this->toArray()[$primaryKey];

        $sql = "DELETE FROM " . static::$table . " WHERE $primaryKey = ?";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("i", $id);

        return $stmt->execute();
    }
}
*/