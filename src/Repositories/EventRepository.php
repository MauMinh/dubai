<?php
include_once __DIR__ . '/../Models/Event.php';

class EventRepository {
    private $conn;
    private $table_name = "events";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getAll() {
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY event_date DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        
        $events = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $events[] = new Event($row); 
        }
        return $events;
    }

    public function create($data) {
        $query = "INSERT INTO " . $this->table_name . " 
                  (title, description, event_date, location, created_by) 
                  VALUES (:title, :description, :event_date, :location, :created_by)";
        
        $stmt = $this->conn->prepare($query);
        
        return $stmt->execute([
            ':title' => $data->title,
            ':description' => $data->description,
            ':event_date' => $data->event_date,
            ':location' => $data->location,
            ':created_by' => $data->created_by // Liên kết với id trong bảng users
        ]);
    }
}