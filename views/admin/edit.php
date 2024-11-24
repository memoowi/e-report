<?php
$page_title = 'Change status Report';
require_once '../views/layout/header.php';
?>

<main>
    <h2>Change Status of <span>Report</span></h2>

    <section>
        <h3>Change status of a Report</h3>
        <p>Evaluate and update the status of a report.</p>

        <form action="<?= url('report-update-status'); ?>" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= $report['id']; ?>">
            <div class="form-group">
                <label for="title">Title:</label>
                <input type="text" name="title" id="title" value="<?= $report['title']; ?>" readonly>
            </div>
            <div class="form-group">
                <label for="description">Description:</label>
                <textarea name="description" id="description" readonly><?= $report['description']; ?></textarea>
            </div>
            <div class="form-group">
                <label>Attachment:</label>
                <?php if ($report['attachment']): ?>
                    <img src="uploads/<?= $report['attachment']; ?>" alt="Attachment" onclick="openImage('uploads/<?= $report['attachment']; ?>')" title="Click to open">
                <?php else: ?>
                    <p>No attachment available.</p>
                <?php endif; ?>
            </div>
            <div class="form-group">
                <label for="status">Status:</label>
                <select name="status" id="status">
                    <option value="pending" <?= $report['status'] === 'pending' ? 'selected' : ''; ?>>Pending</option>
                    <option value="in_progress" <?= $report['status'] === 'in_progress' ? 'selected' : ''; ?>>In Progress</option>
                    <option value="resolved" <?= $report['status'] === 'resolved' ? 'selected' : ''; ?>>Resolved</option>
                    <option value="rejected" <?= $report['status'] === 'rejected' ? 'selected' : ''; ?>>Rejected</option>
                </select>
            </div>
            <div class="form-group">
                <label for="response">Response:</label>
                <textarea name="response" id="response"><?= $report['response']; ?></textarea>
            </div>

            <?php if (isset($error)): ?>
                <p style="color: red;"><?= $error ?></p>
            <?php endif; ?>

            <button class="btn" type="submit">Save</button>
        </form>
    </section>
</main>

<?php require_once '../views/layout/footer.php'; ?>