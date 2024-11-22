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
            <a class="btn home-btn" href="/?page=home">Home</a>
            <a class="btn login-btn" href="/?page=login">Login</a>
            <a class="btn register-btn" href="/?page=register">Register</a>
            <a class="btn logout-btn" href="/?page=logout">Logout</a>
        </nav>
    </header>