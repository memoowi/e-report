<?php

require_once '../helpers/url_helper.php';
require_once '../helpers/auth_helper.php';
require_once '../controllers/AuthController.php';
require_once '../controllers/ReportController.php';
require_once '../controllers/AdminController.php';

$page = $_GET['page'] ?? 'home';

$authController = new AuthController();
$reportController = new ReportController();
$adminController = new AdminController();

// Authentication routes
if ($page === 'login') {
    $authController->showLoginForm();
} elseif ($page === 'register') {
    $authController->showRegisterForm();
} elseif ($page === 'doLogin') {
    $authController->login();
} elseif ($page === 'doRegister') {
    $authController->register();
} elseif ($page === 'logout') {
    $authController->logout();

// User routes
} elseif ($page === 'report-view') {
    $controller = isAdmin() ? $adminController : $reportController;
    $controller->show($_GET['id']);
} elseif ($page === 'report-create') {
    $reportController->create(); 
} elseif ($page === 'report-store') {
    $reportController->store();
} elseif ($page === 'report-edit') {
    $controller = isAdmin() ? $adminController : $reportController;
    $controller->edit($_GET['id']);
} elseif ($page === 'report-update') {
    $reportController->update($_POST['id']); // Handle report update
} elseif ($page === 'report-delete') {
    $reportController->delete($_GET['id']); // Handle report deletion

// Admin routes
} elseif ($page === 'report-update-status') {
    $adminController->update($_POST['id']);
} elseif ($page === 'home') {
    $controller = isAdmin() ? $adminController : $reportController;
    $controller->index();
} else {
    require_once '../views/error-page.php';
}
