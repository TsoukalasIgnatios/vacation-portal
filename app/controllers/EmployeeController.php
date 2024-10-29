<?php

require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../models/VacationRequest.php';

class EmployeeController {
    public function home($userId) {
        $vacationModel = new VacationRequest();
        // Fetch vacation requests specific to the employee
        $requests = $vacationModel->getByUser($userId); 
        include __DIR__ . '/../views/employee/home.php';
    }

    public function requestVacation($userId, $data) {
        $vacationModel = new VacationRequest();
        $data['user_id'] = $userId;
        // Create a new vacation request
        $vacationModel->create($data); 
        //redirect to home page
        header("Location: /public/index.php?route=employee/home");
    }

    public function deleteRequest($requestId) {
        $vacationModel = new VacationRequest();
        // delete vacation request
        $vacationModel->delete($requestId); 
        //redirect to home page
        header("Location: /public/index.php?route=employee/home");
    }
}
