<?php
class User {
    public $id;
    public $username;
    public $password;
    public $full_name;
    public $role;

    public function __construct($data = []) {
        $this->id = $data['id'] ?? null;
        $this->username = $data['username'] ?? null;
        $this->password = $data['password'] ?? null;
        $this->full_name = $data['full_name'] ?? null;
        $this->role = $data['role'] ?? 'member';
    }
}