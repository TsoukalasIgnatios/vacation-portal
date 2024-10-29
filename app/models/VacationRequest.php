<?php
// app/models/VacationRequest.php

require_once __DIR__ . '/../../config/database.php';

class VacationRequest {
    private $conn;

    public function __construct() {
        $this->conn = Database::connect();
    }

    public function create($data) {
        $sql = "INSERT INTO vacation_requests (user_id, start_date, end_date, reason, status) VALUES (:user_id, :start_date, :end_date, :reason, 'pending')";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute($data);
    }

    public function getAll() {
        $sql="SELECT vacation_requests.*, users.name user_name FROM vacation_requests JOIN Users ON vacation_requests.user_id = users.id ";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getByUser($user_id) {
        $stmt = $this->conn->prepare("SELECT * FROM vacation_requests WHERE user_id = :user_id");
        $stmt->execute(['user_id' => $user_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // public function updateStatus($id, $status) {
    //     $stmt = $this->conn->prepare("UPDATE vacation_requests SET status = :status WHERE id = :id");
    //     return $stmt->execute(['status' => $status, 'id' => $id]);
    // }

    // Approve a vacation request by ID
    public function approve($id) {
        $sql = "UPDATE vacation_requests SET status = 'approved' WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    // Reject a vacation request by ID
    public function reject($id) {
        $sql = "UPDATE vacation_requests SET status = 'rejected' WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function delete($id) {
        $sql = "DELETE FROM vacation_requests WHERE id = :id AND status = 'pending' ";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
