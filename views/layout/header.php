<?php
require_once '../helpers/auth_helper.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>e-Report <?php echo isset($page_title) ? "| $page_title" : ""; ?></title>
    <link rel="stylesheet" href="./css/style.css">
    <script src="./js/script.js" defer></script>
</head>

<body>
    <header>
        <h1>E-Report</h1>
        <nav>
            <?php if (isAuthenticated()): ?>
                <a class="btn home-btn" href="<?= url('home'); ?>">Home</a>
                <a class="btn logout-btn" href="<?= url('logout'); ?>">Logout</a>
            <?php else:; ?>
                <a class="btn login-btn" href="<?= url('login'); ?>">Login</a>
                <a class="btn register-btn" href="<?= url('register'); ?>">Register</a>
            <?php endif; ?>
        </nav>
    </header>