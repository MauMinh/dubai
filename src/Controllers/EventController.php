<?php
// src/Controllers/EventController.php
include_once __DIR__ . '/../Repositories/EventRepository.php';
include_once __DIR__ . '/../Services/EventService.php';

$repository = new EventRepository($db); // Biến $db được truyền từ index.php
$service = new EventService($repository);

$method = $_SERVER['REQUEST_METHOD'];

// API Lấy danh sách sự kiện
if ($method == 'GET' && $action == 'list') {
    $events = $service->getAllEvents();
    echo json_encode($events);
    exit;
}

// API Tạo sự kiện mới
if ($method == 'POST' && $action == 'create') {
    $data = json_decode(file_get_contents("php://input"));
    $result = $service->createEvent($data);
    echo json_encode($result);
    exit;
}
?>