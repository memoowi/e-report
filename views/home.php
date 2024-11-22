<?php 
$page_title = 'Home';
require_once '../views/layout/header.php'; 
?>

<main>
    <h2>Login</h2>
    <form action="/?page=doLogin" method="POST">
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required>
        
        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required>
        
        <button type="submit">Login</button>
    </form>
    <p>Don't have an account? <a href="/?page=register">Register here</a>.</p>
</main>

<?php require_once '../views/layout/footer.php'; ?>
