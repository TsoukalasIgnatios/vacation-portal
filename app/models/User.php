<?php

require_once '../config/database.php';

class User {
    private $conn;

    public function __construct() {
        $this->conn = Database::connect();
    }
     

    public function create($data) {
        $sql = "INSERT INTO users (name, email, employee_code, password, role) VALUES (:name, :email, :employee_code, :password, :role)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute($data);
    }

    public function getAll() {
        $sql = "SELECT * FROM users";
        return $this->conn->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update($id, $data) {
        $sql = "UPDATE users SET name = :name, email = :email, password = :password WHERE id = :id";
        $data['id'] = $id;
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute($data);
    }

    public function delete($id) {
        $this->deleteAssociatedData($id);
        $stmt = $this->conn->prepare("DELETE FROM users WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }
    private function deleteAssociatedData($userId) {
        // Assuming we have a vacation_requests table that links to users by user_id
        $stmt = $this->conn->prepare("DELETE FROM vacation_requests WHERE user_id = :user_id");
        $stmt->execute(['user_id' => $userId]);
    }

    public function findByUsername($username) {
        // $db = Database::connect();
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->execute(['email' => $username]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    
}
