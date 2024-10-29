<?php
// public/index.php

session_start();
require_once __DIR__ . '/../vendor/autoload.php';
$route = $_GET['route'] ?? 'auth/login';
require_once __DIR__ . '/../app/controllers/AuthController.php';
require_once __DIR__ . '/../app/controllers/ManagerController.php';
require_once __DIR__ . '/../app/controllers/EmployeeController.php';

switch ($route) {
    case 'auth/login':
        $controller = new AuthController();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $controller->login($_POST['username'], $_POST['password']);
        } else {
            include __DIR__ . '/../app/views/auth/login.php';
        }
        break;
    case 'auth/logout': // New logout route
        require_once '../app/controllers/AuthController.php';
        $controller = new AuthController();
        $controller->logout(); // Call the logout method
        break;

    case 'manager/home':
        $controller = new ManagerController();
        $controller->home();
        break;

        case 'manager/create_user':
            $controller = new ManagerController();
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $controller->createUser($_POST);
            } else {
                include __DIR__ . '/../app/views/manager/create_user.php';
            }
            break;
    
        case 'manager/update_user':
            $controller = new ManagerController();
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $controller->updateUser($_GET['id'], $_POST);
            } else {
                $controller->editUser($_GET['id']); // Load user data into form
            }
            break;
        
        case 'manager/delete_user':
            $controller = new ManagerController();
            if ($_SERVER['REQUEST_METHOD'] === 'GET') {
                $controller->deleteUser($_GET['id']);
            } 
            break;
    
        case 'manager/vacation_requests':
            // if ($_SERVER['REQUEST_METHOD'] === 'GET'){
                $controller = new ManagerController();
                $controller->viewVacationRequests();
            // }
            break;
    
        case 'employee/home':
            $controller = new EmployeeController();
            $controller->home($_SESSION['user']['id']);
            break;
    
        case 'employee/request_vacation':
            $controller = new EmployeeController();
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $controller->requestVacation($_SESSION['user']['id'], $_POST);
            } else {
                include __DIR__ . '/../app/views/employee/request_vacation.php';
            }
            break;

        case 'manager/approve_request':
            $controller = new ManagerController();
            if ($_SERVER['REQUEST_METHOD'] === 'GET') {
                $controller->approveRequest($_GET['id']);
            } 
            
            break;

        case 'manager/reject_request':
            $controller = new ManagerController();
            if ($_SERVER['REQUEST_METHOD'] === 'GET') {
                $controller->rejectRequest($_GET['id']);
            }

            break;
            
        case 'employee/delete_request':
            $controller = new EmployeeController();
            if ($_SERVER['REQUEST_METHOD'] === 'GET') {
                $controller->deleteRequest($_GET['id']);
            } 
            
            break;
    
        default:
            include __DIR__ . '/../app/views/auth/login.php';
            break;
            
}
    

