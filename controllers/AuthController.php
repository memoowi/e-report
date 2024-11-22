<?php

class AuthController {
    public function showLoginForm() {
        require_once '../views/auth/login.php';
    }

    public function showRegisterForm() {
        require_once '../views/auth/register.php';
    }

    public function login() {
        // Handle login logic
        echo "Logging in...";
    }

    public function register() {
        // Handle registration logic
        echo "Registering user...";
    }

    public function logout() {
        // Handle logout logic
        echo "Logging out...";
    }
}
