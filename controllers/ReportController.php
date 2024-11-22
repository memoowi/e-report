<?php

class ReportController {
    public function index() {
        require_once '../views/reports/list.php';
    }

    public function create() {
        require_once '../views/reports/create.php';
    }

    public function store() {
        // Handle saving a new report to the database
        echo "Storing new report...";
    }

    public function edit($id) {
        require_once '../views/reports/edit.php';
    }

    public function update($id) {
        // Handle updating an existing report in the database
        echo "Updating report with ID: $id";
    }

    public function delete($id) {
        // Handle deleting a report
        echo "Deleting report with ID: $id";
    }
}
