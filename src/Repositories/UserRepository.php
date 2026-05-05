<?php
include_once __DIR__ . '/../Models/User.php';
class UserRepository {
    private $conn;
    private $table_name = "users";

    public function __construct($db) {
        $this->conn = $db;
    }
    public function getAll() {
        $query = "SELECT * FROM users";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        
        $users = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $users[] = new User($row); 
        }
        return $users;
    }
    public function login($username, $password) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE username = ? AND password = ? LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$username, $password]);
        
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            return new User($row);
        }
        return null;
    }
    public function register($data) {
    // Kiểm tra trùng username
    $check = "SELECT id FROM " . $this->table_name . " WHERE username = ?";
    $stmtCheck = $this->conn->prepare($check);
    $stmtCheck->execute([$data->username]);
    if ($stmtCheck->rowCount() > 0) return false;

    $query = "INSERT INTO " . $this->table_name . " (username, password, full_name, role) VALUES (?, ?, ?, ?)";
    $stmt = $this->conn->prepare($query);
    return $stmt->execute([
        $data->username,
        $data->password,
        $data->full_name,
        $data->role
    ]);
    }
}
?>