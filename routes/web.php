<?php

// Import necessary controllers
require_once '../helpers/url_helper.php';
require_once '../controllers/AuthController.php';
require_once '../controllers/ReportController.php';
// require_once '../controllers/CommentController.php';

// Define routing logic
$page = $_GET['page'] ?? 'home'; // Default route

$authController = new AuthController();
$reportController = new ReportController();

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

// // Report routes
// } elseif ($page === 'reports') {
//     $reportController = new ReportController();
//     $reportController->index(); // Show all reports
} elseif ($page === 'report-view') {
    $reportController->show($_GET['id']); // Show a single report
} elseif ($page === 'report-create') {
    $reportController->create(); // Show form to create a report
} elseif ($page === 'report-store') {
    $reportController->store(); // Handle form submission for new report
} elseif ($page === 'report-edit') {
    $reportController->edit($_GET['id']); // Show form to edit a report
} elseif ($page === 'report-update') {
    $reportController->update($_POST['id']); // Handle report update
} elseif ($page === 'report-delete') {
    $reportController->delete($_GET['id']); // Handle report deletion

// // Comment routes
// } elseif ($page === 'comment_store') {
//     $commentController = new CommentController();
//     $commentController->store(); // Handle comment submission
// } elseif ($page === 'comment_delete') {
//     $commentController = new CommentController();
//     $commentController->delete($_GET['id']); // Handle comment deletion

// Default route
} elseif ($page === 'home') {
    $reportController->index();
} else {
    require_once '../views/error-page.php';
}
