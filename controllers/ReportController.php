<?php

require_once '../models/Report.php';
require_once '../helpers/url_helper.php';
require_once '../helpers/auth_helper.php';
require_once '../helpers/input_helper.php';

class ReportController
{
    private $reportModel;

    public function __construct()
    {
        $this->reportModel = new Report();
    }

    public function index()
    {
        if (!isAuthenticated()) {
            redirect('login');
            exit;
        }
        $reports = $this->reportModel->getByUserId($_SESSION['user']['id']);

        require_once '../views/reports/home.php';
    }

    public function show($id)
    {
        if (!isAuthenticated()) {
            redirect('login');
            exit;
        }
        $report = $this->reportModel->getById($id);

        if (!$report) {
            $error = "Report not found";
            require_once '../views/error-page.php';
        } else {
            if ($report['user_id'] !== $_SESSION['user']['id']) {
                $error = "You don't have permission to view this report";
                require_once '../views/error-page.php';
            }
            require_once '../views/reports/view.php';
        }
    }

    public function create()
    {
        if (!isAuthenticated()) {
            redirect('login');
            exit;
        }
        require_once '../views/reports/create.php';
    }
    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = $_POST['title'] ?? '';
            $description = $_POST['description'] ?? '';
            $attachment = $_FILES['attachment'] ?? null;
            $userId = $_SESSION['user']['id'];

            if (empty($title) || empty($description)) {
                $error = "Title and Description fields are required";
                require_once '../views/reports/create.php';
                return;
            }

            $title = sanitizeString($title);
            $description = sanitizeString($description);

            if ($attachment && $attachment['error'] === UPLOAD_ERR_OK) {
                $allowedExtensions = ['jpg', 'jpeg', 'png'];
                $fileExtension = strtolower(pathinfo($attachment['name'], PATHINFO_EXTENSION));

                if (!in_array($fileExtension, $allowedExtensions)) {
                    $error = "Only accept images (.jpg, .jpeg, .png).";
                    require_once '../views/reports/create.php';
                    return;
                }

                if ($attachment['size'] > 5 * 1024 * 1024) {
                    $error = "Maximum file size is 5MB.";
                    require_once '../views/reports/create.php';
                    return;
                }

                $fileName = time() . '-' . uniqid() . '.' . $fileExtension;
                $uploadDir = './uploads/';
                $uploadPath = $uploadDir . $fileName;

                if (move_uploaded_file($attachment['tmp_name'], $uploadPath)) {
                    $this->reportModel->create($title, $description, $fileName, $userId);
                    redirect('home');
                } else {
                    $error = "Failed to upload file.";
                    require_once '../views/reports/create.php';
                }
            } else {
                $this->reportModel->create($title, $description, null, $userId);
                redirect('home');
            }
        }
    }

    // public function edit($id) {
    //     require_once '../views/reports/edit.php';
    // }

    // public function update($id) {
    //     // Handle updating an existing report in the database
    //     echo "Updating report with ID: $id";
    // }

    public function delete($id)
    {
        if (!isAuthenticated()) {
            redirect('login');
            exit;
        } else {
            $report = $this->reportModel->getById($id);
            if ($report['user_id'] !== $_SESSION['user']['id']) {
                $error = "You don't have permission to delete this report";
                require_once '../views/error-page.php';
            } else {
                if ($report['attachment']) {
                    unlink('./uploads/' . $report['attachment']);
                }
                $this->reportModel->delete($id);
                redirect('home');
            }
        }
    }
}
