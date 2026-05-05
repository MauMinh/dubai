<?php
class UserService {
    private $repository;

    public function __construct($repository) {
        $this->repository = $repository;
    }

    public function login($username, $password) {
        $user = $this->repository->login($username, $password);
        
        if ($user) {
            $user->password = null; 
            return $user;
        }
        return false;
    }

    public function register($data) {
    if (empty($data->username) || empty($data->password) || empty($data->full_name)) {
        return false;
    }
    return $this->repository->register($data);
    }

    public function getUserList() {
        return $this->repository->getAll();
    }
}