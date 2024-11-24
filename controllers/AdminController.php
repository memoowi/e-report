<?php

require_once '../models/Report.php';
require_once '../helpers/url_helper.php';
require_once '../helpers/auth_helper.php';
require_once '../helpers/input_helper.php';

class AdminController
{

    private $reportModel;

    public function __construct()
    {
        $this->reportModel = new Report();
    }

    public function index()
    {
        requireAuth();
        $reports = $this->reportModel->getAll();

        require_once '../views/admin/home.php';
    }

    public function show($id)
    {
        requireAuth();
        $report = $this->reportModel->getById($id);

        if (!$report) {
            $error = "Report not found";
            require_once '../views/error-page.php';
        } else {
            require_once '../views/reports/view.php';
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
        } else {
            require_once '../views/admin/edit.php';
        }
    }
    public function update($id)
    {
        requireAuth();
        requireAdmin();

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $status = $_POST['status'] ?? '';
            $response = $_POST['response'] ?? '';
            $report = $this->reportModel->getById($id);

            if (empty($status) || !in_array($status, ['pending', 'in_progress', 'resolved', 'rejected'])) {
                $error = "Invalid status";
                require_once '../views/admin/edit.php';
                return;
            }

            if (empty($response)) {
                $error = "Response field is required";
                require_once '../views/admin/edit.php';
                exit;
            }

            $response = sanitizeString($response);

            if ($this->reportModel->changeStatus($id, $status, $response)) {
                redirect('home');
            } else {
                $error = "Failed to update report status";
                require_once '../views/error-page.php';
            }
        }
    }
}
