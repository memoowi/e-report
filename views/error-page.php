<?php 
$page_title = 'Error';
require_once '../views/layout/header.php'; 
?>

<main class="error-main">
    <h2>Error</h2>
    <p><?php echo $error ?? "Page not found"; ?></p>
    <a class="btn" href="./">Go back to the homepage</a>
</main>

<?php require_once '../views/layout/footer.php'; ?>
