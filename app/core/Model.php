<?php

class Model
{
    protected object $conn;
    protected string $table;

    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->conn;
    }

    public function all(): array
    {
        $sql = "SELECT * FROM {$this->table}";
        $result = $this->conn->query($sql);

        if ($result->num_rows > 0) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            echo "no results";
        }
    }

    public function find(int $id): array
    {
        $stmt = $this->conn->prepare("SELECT * FROM {$this->table} WHERE id = ?");

        $stmt->bind_param('i', $id);

        if ($stmt->execute() === TRUE) {
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
            return $row ? : [];
        } else {
            return false;
        }
    }

    public function store(array $data, string $types): void
    {
        $keys = implode(", ", array_keys($data));
        $placeholders = implode(", ", array_fill(0, count($data), "?"));
        $values = array_values($data);

        $stmt = $this->conn->prepare("INSERT INTO {$this->table} ($keys) VALUES ($placeholders)");

        $stmt->bind_param($types, ...$values);

        if ($stmt->execute() === FALSE) {
            echo "Error: " . $stmt->error;
        }
    }

    public function update(int $id, array $data, string $types): void
    {
        $pairs = [];
        $values = [];
        foreach ($data as $key => $value) {
            $pairs[] = "$key = ?";
            $values[] = $value;
        }
        $keyValuePairs = implode(", ", $pairs);

        $values[] = $id;

        $stmt = $this->conn->prepare("UPDATE {$this->table} SET $keyValuePairs WHERE id = ?");

        $stmt->bind_param($types . 'i', ...$values);

        if ($stmt->execute() === FALSE) {
            echo "Error: " . $stmt->error;
        }
    }

    public function delete(int $id): void
    {
        $stmt = $this->conn->prepare("DELETE FROM {$this->table} WHERE id = ?");

        $stmt->bind_param('i', $id);

        if ($stmt->execute() === FALSE) {
            echo "Error: " . $stmt->error;
        }
    }
}
