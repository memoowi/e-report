<?php
$page_title = 'Edit Report';
require_once '../views/layout/header.php';
?>

<main>
    <h2>Edit <span>Report</span></h2>

    <section>
        <h3>Update a Report</h3>
        <p>Use this form to update a report.</p>

        <form action="<?= url('report-update'); ?>" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= $report['id']; ?>">
            <div class="form-group">
                <label for="title">Title:</label>
                <input type="text" name="title" id="title" value="<?= $report['title']; ?>">
            </div>
            <div class="form-group">
                <label for="description">Description:</label>
                <textarea name="description" id="description"><?= $report['description']; ?></textarea>
            </div>
            <div class="form-group">
                <label>Current Attachment:</label>
                <?php if ($report['attachment']): ?>
                    <img src="uploads/<?= $report['attachment']; ?>" alt="Attachment" onclick="openImage('uploads/<?= $report['attachment']; ?>')" title="Click to open">
                <?php else: ?>
                    <p>No attachment available.</p>
                <?php endif; ?>
            </div>
            <div class="form-group">
                <label for="attachment">Edit Attachment (optional):</label>
                <span>Only accept images (.jpg, .jpeg, .png). Max size: 5MB</span>
                <input type="file" name="attachment" id="attachment" accept="image/*">
            </div>

            <?php if (isset($error)): ?>
                <p style="color: red;"><?= $error ?></p>
            <?php endif; ?>

            <button class="btn" type="submit">Update</button>
        </form>
    </section>
</main>

<script>
    const img = document.querySelector('img');
    const input = document.querySelector('#attachment');

    input.addEventListener('change', () => {
        img.src = URL.createObjectURL(input.files[0]);
        img.alt = input.files[0].name;
        img.title = input.files[0].name;
    })
</script>

<?php require_once '../views/layout/footer.php'; ?>