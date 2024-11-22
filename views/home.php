<?php 
$page_title = 'Home';
require_once '../views/layout/header.php'; 
require_once '../helpers/auth_helper.php';
requireAuth();
?>

<main>
    <h2>Welcome to E-Report</h2>
</main>

<?php require_once '../views/layout/footer.php'; ?>
