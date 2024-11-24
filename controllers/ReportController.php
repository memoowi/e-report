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
        requireAuth();
        $reports = $this->reportModel->getByUserId($_SESSION['user']['id']);

        require_once '../views/reports/home.php';
    }

    public function show($id)
    {
        requireAuth();
        $report = $this->reportModel->getById($id);

        if (!$report) {
            $error = "Report not found";
            require_once '../views/error-page.php';
        } else {
            if ($report['user_id'] !== $_SESSION['user']['id']) {
                $error = "You don't have permission to view this report";
                require_once '../views/error-page.php';
                exit;
            }
            require_once '../views/reports/view.php';
        }
    }

    public function create()
    {
        requireAuth();
        if (isAdmin()) {
            $error = "Admin User don't have permission to create a report";
            require_once '../views/error-page.php';
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

    public function edit($id)
    {
        requireAuth();

        $report = $this->reportModel->getById($id);

        if (!$report) {
            $error = "Report not found";
            require_once '../views/error-page.php';
            return;
        }
        if ($report['user_id'] !== $_SESSION['user']['id']) {
            $error = "You don't have permission to edit this report";
            require_once '../views/error-page.php';
            exit;
        } else {
            require_once '../views/reports/edit.php';
        }
    }

    public function update($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = $_POST['title'] ?? '';
            $description = $_POST['description'] ?? '';
            $attachment = $_FILES['attachment'] ?? null;
            $report = $this->reportModel->getById($id);

            if (empty($title) || empty($description)) {
                $error = "Title and Description fields are required";
                require_once '../views/reports/edit.php';
                return;
            }

            $title = sanitizeString($title);
            $description = sanitizeString($description);

            if ($attachment && $attachment['error'] === UPLOAD_ERR_OK) {
                $allowedExtensions = ['jpg', 'jpeg', 'png'];
                $fileExtension = strtolower(pathinfo($attachment['name'], PATHINFO_EXTENSION));

                if (!in_array($fileExtension, $allowedExtensions)) {
                    $error = "Only accept images (.jpg, .jpeg, .png).";
                    require_once '../views/reports/edit.php';
                    return;
                }

                if ($attachment['size'] > 5 * 1024 * 1024) {
                    $error = "Maximum file size is 5MB.";
                    require_once '../views/reports/edit.php';
                    return;
                }

                if ($report['attachment']) {
                    unlink('./uploads/' . $report['attachment']);
                }

                $fileName = time() . '-' . uniqid() . '.' . $fileExtension;
                $uploadDir = './uploads/';
                $uploadPath = $uploadDir . $fileName;

                if (move_uploaded_file($attachment['tmp_name'], $uploadPath)) {
                    $this->reportModel->update($id, $title, $description, $fileName);
                    redirect('home');
                } else {
                    $error = "Failed to upload file.";
                    require_once '../views/reports/edit.php';
                }
            } else {
                $this->reportModel->update($id, $title, $description, $report['attachment']);
                redirect('home');
            }
        }
    }

    public function delete($id)
    {
        requireAuth();

        $report = $this->reportModel->getById($id);
        if ($report['user_id'] !== $_SESSION['user']['id']) {
            $error = "You don't have permission to delete this report";
            require_once '../views/error-page.php';
            exit;
        } else {
            if ($report['attachment']) {
                unlink('./uploads/' . $report['attachment']);
            }
            $this->reportModel->delete($id);
            redirect('home');
        }
    }
}
