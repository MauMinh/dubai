<?php
class EventService {
    private $repository;

    public function __construct($repository) {
        $this->repository = $repository;
    }

    public function getAllEvents() {
        return $this->repository->getAll();
    }

    public function createEvent($data) {
        // Logic kiểm tra: Ngày sự kiện phải lớn hơn ngày hiện tại
        if (strtotime($data->event_date) < time()) {
            return ["status" => "error", "message" => "Ngày sự kiện không được ở quá khứ"];
        }
        
        if ($this->repository->create($data)) {
            return ["status" => "success", "message" => "Tạo sự kiện thành công"];
        }
        return ["status" => "error", "message" => "Không thể tạo sự kiện"];
    }
}
?>