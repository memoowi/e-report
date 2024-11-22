<?php 
$page_title = 'Register';
require_once '../views/layout/header.php'; 
?>

<main>
    <h2>Register</h2>
    <form action="<?= url('doRegister'); ?>" method="POST">
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" name="name" id="name" required>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" required>
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" required>
        </div>
        <div class="form-group">
            <label for="confirm-password">Confirm Password:</label>
            <input type="password" name="confirm-password" id="confirm-password" required>
        </div>
        
        <button class="btn" type="submit">Register</button>
    </form>
    <p>Already have an account? <a class="a-link" href="<?= url('login'); ?>">Login here</a>.</p>
</main>

<?php require_once '../views/layout/footer.php'; ?>
