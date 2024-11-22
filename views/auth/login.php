<?php 
$page_title = 'Login';
require_once '../views/layout/header.php'; 
?>

<main>
    <h2>Login</h2>
    <form action="<?= url('doLogin'); ?>" method="POST">
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" name="email" id="email">
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <div class="password-container">
                <input type="password" name="password" id="password">
                <i class="fas fa-eye" onclick="togglePassoword('password', 'eye')" id="eye"></i>
            </div>
        </div>

        <?php if (isset($error)): ?>
            <p style="color: red;"><?= $error ?></p>
        <?php endif; ?>
        
        <button class="btn" type="submit">Login</button>
    </form>
    <p>Don't have an account? <a class="a-link" href="<?= url('register'); ?>">Register here</a>.</p>
</main>

<?php require_once '../views/layout/footer.php'; ?>
