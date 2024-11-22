<?php 
$page_title = 'Login';
require_once '../views/layout/header.php'; 
?>

<main>
    <h2>Login</h2>
    <form action="<?= url('doLogin'); ?>n" method="POST">
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" required>
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" required>
        </div>
        
        <button class="btn" type="submit">Login</button>
    </form>
    <p>Don't have an account? <a class="a-link" href="<?= url('register'); ?>">Register here</a>.</p>
</main>

<?php require_once '../views/layout/footer.php'; ?>
