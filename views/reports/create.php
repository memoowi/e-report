<?php
$page_title = 'New Report';
require_once '../views/layout/header.php';
?>

<main>
    <h2>New <span>Report</span></h2>

    <section>
        <h3>Create a Report</h3>
        <p>Use this form to create a new report.</p>
        <!-- <a class="btn" href="<?= url('report_create'); ?>">
            Create Report &nbsp;
            <i class="fas fa-plus"></i>
        </a> -->

        <form action="<?= url('report_store'); ?>" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="title">Title:</label>
                <input type="text" name="title" id="title">
            </div>
            <div class="form-group">
                <label for="description">Description:</label>
                <textarea name="description" id="description"></textarea>
            </div>
            <div class="form-group">
                <label for="attachment">Attachment (optional):</label>
                <span>Only accept images (.jpg, .jpeg, .png). Max size: 5MB</span>
                <input type="file" name="attachment" id="attachment" accept="image/*">
            </div>

            <?php if (isset($error)): ?>
                <p style="color: red;"><?= $error ?></p>
            <?php endif; ?>

            <button class="btn" type="submit">Submit</button>
        </form>
    </section>
</main>

<?php require_once '../views/layout/footer.php'; ?>