<?php
class Profile {
    public $id;
    public $username;
    public $full_name;
    public $email;
    public $role;
    public $created_at;

    public function __construct($data = []) {
        $this->id         = $data['id'] ?? null;
        $this->username   = $data['username'] ?? null;
        $this->full_name  = $data['full_name'] ?? null;
        $this->email      = $data['email'] ?? null;
        $this->role       = $data['role'] ?? 'member';
        $this->created_at = $data['created_at'] ?? null;
    }
}
?>