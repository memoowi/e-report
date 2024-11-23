<?php

require_once '../models/User.php';
require_once '../helpers/url_helper.php';
require_once '../helpers/auth_helper.php';
require_once '../helpers/input_helper.php';

class AuthController
{

    private $userModel;

    public function __construct()
    {
        $this->userModel = new User();
    }

    public function showLoginForm()
    {
        if (isAuthenticated()) {
            redirect('home');
            exit;
        }
        require_once '../views/auth/login.php';
    }

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';

            if (empty($email) || empty($password)) {
                $error = "All fields are required";
                require_once '../views/auth/login.php';
                return;
            }

            $email = sanitizeEmail($email);
            $password = sanitizePassword($password);

            if ($email === false) {
                $error = "Invalid email format";
                require_once '../views/auth/login.php';
                return;
            } elseif ($password === false) {
                $error = "Password at least 8 characters";
                require_once '../views/auth/login.php';
                return;
            }

            $user = $this->userModel->getUserByEmail($email);
            if ($user) {
                if (password_verify($password, $user['password'])) {
                    session_start();
                    $_SESSION['user'] = $user;
                    session_regenerate_id(true);  
                    redirect('home'); 
                } else {
                    $error = "Incorrect password";
                    require_once '../views/auth/login.php';
                }
            } else {
                $error = "User not found";
                require_once '../views/auth/login.php';
            }
        }
    }

    public function showRegisterForm()
    {
        if (isAuthenticated()) {
            redirect('home');
            exit;
        }
        require_once '../views/auth/register.php';
    }

    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'] ?? '';
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';
            $confirmPassword = $_POST['confirm-password'] ?? '';

            if (empty($name) || empty($email) || empty($password) || empty($confirmPassword)) {
                $error = "All fields are required";
                require_once '../views/auth/register.php';
                return;
            }

            $name = sanitizeString($name);
            $email = sanitizeEmail($email);
            $password = sanitizePassword($password);
            $confirmPassword = sanitizePassword($confirmPassword);

            if ($name === false) {
                $error = "Invalid name format";
                require_once '../views/auth/register.php';
                return;
            } elseif ($email === false) {
                $error = "Invalid email format";
                require_once '../views/auth/register.php';
                return;
            } elseif ($password === false) {
                $error = "Password at least 8 characters";
                require_once '../views/auth/register.php';
                return;
            } elseif ($confirmPassword === false) {
                $error = "Confirm password at least 8 characters";
                require_once '../views/auth/register.php';
                return;
            }

            if ($password !== $confirmPassword) {
                $error = "Passwords does not match.";
                require_once '../views/auth/register.php';
                return;
            }

            if ($this->userModel->emailExists($email)) {
                $error = "Email already registered.";
                require_once '../views/auth/register.php';
                return;
            }

            if ($this->userModel->createUser($name, $email, $password)) {
                $user = $this->userModel->getUserByEmail($email);
                session_start();
                $_SESSION['user'] = $user;
                session_regenerate_id(true);
                redirect('home');
            } else {
                $error = "Failed to register user. Please try again.";
                require_once '../views/auth/register.php';
            }
        }
    }

    public function logout()
    {
        session_start();
        session_destroy();
        redirect('login');
        exit;
    }
}
