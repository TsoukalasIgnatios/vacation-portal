<?php

require_once __DIR__ . '/../models/User.php';

class AuthController {
    public function login($username, $password) {
        $userModel = new User();
        $user = $userModel->findByUsername($username);
        // login authentication proccess case of manager or employee
        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user'] = $user;
            header("Location: /public/index.php?route=" . ($user['role'] === 'manager' ? "manager/home" : "employee/home"));
        } else {
            $_SESSION['login_error'] = "Invalid username or password";
            header("Location: /public/index.php?route=auth/login");
        }
    }

    public function logout() {
        // Destroy the session
        session_start();
        session_unset();
        session_destroy();
        
        // Redirect to login page
        header("Location: index.php?route=auth/login");
        exit();
    }
}
