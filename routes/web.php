<?php

// Import necessary controllers
require_once '../controllers/AuthController.php';
// require_once '../controllers/ReportController.php';
// require_once '../controllers/CommentController.php';

// Define routing logic
$page = $_GET['page'] ?? 'home'; // Default route

// Authentication routes
if ($page === 'login') {
    $authController = new AuthController();
    $authController->showLoginForm();
// } elseif ($page === 'register') {
//     $authController = new AuthController();
//     $authController->showRegisterForm();
// } elseif ($page === 'doLogin') {
//     $authController = new AuthController();
//     $authController->login();
// } elseif ($page === 'doRegister') {
//     $authController = new AuthController();
//     $authController->register();
// } elseif ($page === 'logout') {
//     $authController = new AuthController();
//     $authController->logout();

// // Report routes
// } elseif ($page === 'reports') {
//     $reportController = new ReportController();
//     $reportController->index(); // Show all reports
// } elseif ($page === 'report_create') {
//     $reportController = new ReportController();
//     $reportController->create(); // Show form to create a report
// } elseif ($page === 'report_store') {
//     $reportController = new ReportController();
//     $reportController->store(); // Handle form submission for new report
// } elseif ($page === 'report_edit') {
//     $reportController = new ReportController();
//     $reportController->edit($_GET['id']); // Show form to edit a report
// } elseif ($page === 'report_update') {
//     $reportController = new ReportController();
//     $reportController->update($_POST['id']); // Handle report update
// } elseif ($page === 'report_delete') {
//     $reportController = new ReportController();
//     $reportController->delete($_GET['id']); // Handle report deletion

// // Comment routes
// } elseif ($page === 'comment_store') {
//     $commentController = new CommentController();
//     $commentController->store(); // Handle comment submission
// } elseif ($page === 'comment_delete') {
//     $commentController = new CommentController();
//     $commentController->delete($_GET['id']); // Handle comment deletion

// Default route
} elseif ($page === 'home') {
    require_once '../views/home.php';
} else {
    require_once '../views/error-page.php';
}
