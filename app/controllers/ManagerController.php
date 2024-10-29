<?php

require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../models/VacationRequest.php';

class ManagerController {
    public function home() {
        $userModel = new User();
        // fetch all users
        $users = $userModel->getAll();
        
        include __DIR__ . '/../views/manager/home.php';
    }

    public function createUser($data) {
        $userModel = new User();
        // Hash password
        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT); 
        // create a user
        $userModel->create($data);
        //redirect to home page
        header("Location: /public/index.php?route=manager/home");
    }

    public function deleteUser($id) {
        $userModel = new User();
        // delete a user
        $userModel->delete($id);
        //redirect to home page
        header("Location: /public/index.php?route=manager/home");
    }

    public function editUser($id) {
        $userModel = new User();
        // get user
        $user = $userModel->getById($id);
        // Preload form with user data
        include __DIR__ . '/../views/manager/update_user.php'; 
    }

    public function updateUser($id, $data) {
        $userModel = new User();
        if (!empty($data['password'])) {
            $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        }
        $userModel->update($id, $data);
        // redirect to home page
        header("Location: /public/index.php?route=manager/home");
    }
    
    public function viewVacationRequests() {
        $vacationModel = new VacationRequest();
        // get all requests and view them
        $requests = $vacationModel->getAll();
        include __DIR__ . '/../views/manager/vacation_requests.php';
    }

    public function approveRequest($id) {
        $vacationModel = new VacationRequest();
        // approve arequest
        $requests = $vacationModel->approve($id);
        header("Location: /public/index.php?route=manager/vacation_requests");
    }

    public function rejectRequest($id) {
        $vacationModel = new VacationRequest();
        // reject a request
        $requests = $vacationModel->reject($id);
        header("Location: /public/index.php?route=manager/vacation_requests");
    }
    
}
