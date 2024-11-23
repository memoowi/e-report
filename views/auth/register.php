<?php
$page_title = 'Register';
require_once '../views/layout/header.php';
?>

<main>
    <h2>Register</h2>
    <form class="auth-form" action="<?= url('doRegister'); ?>" method="POST">
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" name="name" id="name">
        </div>
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
        <div class="form-group">
            <label for="confirm-password">Confirm Password:</label>
            <div class="password-container">
                <input type="password" name="confirm-password" id="confirm-password">
                <i class="fas fa-eye" onclick="togglePassoword('confirm-password')"></i>
            </div>
        </div>

        <?php if (isset($error)): ?>
            <p style="color: red;"><?= $error ?></p>
        <?php endif; ?>

        <button class="btn" type="submit">Register</button>
    </form>
    <p>Already have an account? <a class="a-link" href="<?= url('login'); ?>">Login here</a>.</p>
</main>

<?php require_once '../views/layout/footer.php'; ?>