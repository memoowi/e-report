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

    // public function index() {
    //     require_once '../views/reports/list.php';
    // }


    // public function edit($id) {
    //     require_once '../views/reports/edit.php';
    // }

    // public function update($id) {
    //     // Handle updating an existing report in the database
    //     echo "Updating report with ID: $id";
    // }

    // public function delete($id) {
    //     // Handle deleting a report
    //     echo "Deleting report with ID: $id";
    // }
}
