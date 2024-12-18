<?php
$page_title = 'View Report';
require_once '../views/layout/header.php';
require_once '../helpers/date_helper.php';
require_once '../helpers/auth_helper.php';
?>

<main>
    <h2>View <span>Report</span></h2>

    <section>
        <h3>Report Details</h3>
        <p>Here are the details of the report.</p>

        <article>
            <h4>Title:</h4>
            <p><?= $report['title']; ?></p>

            <h4>Description:</h4>
            <p><?= $report['description']; ?></p>

            <h4>Attachment:</h4>
            <?php if ($report['attachment']): ?>
                <img src="uploads/<?= $report['attachment']; ?>" alt="Attachment" onclick="openImage('uploads/<?= $report['attachment']; ?>')" title="Click to open">
            <?php else: ?>
                <p>No attachment available.</p>
            <?php endif; ?>

            <h4>Status:</h4>
            <p><?= $report['status']; ?></p>

            <h4>Response:</h4>
            <p><?= $report['response'] ?? 'No response'; ?></p>

            <h4>Created At:</h4>
            <p><?= format_date($report['created_at']) ?></p>

            <h4>Updated At:</h4>
            <p><?= format_date($report['updated_at']) ?></p>

            <div class="actions">
                <a class="btn edit-btn" href="<?= url('report-edit', ['id' => $report['id']]); ?>">
                    <i class="fas fa-edit"></i>
                </a>
                <?php if (!isAdmin()): ?>
                    <a class="btn delete-btn" href="<?= url('report-delete', ['id' => $report['id']]); ?>">
                        <i class="fas fa-trash"></i>
                    </a>
                <?php endif; ?>
            </div>
        </article>

    </section>
</main>

<?php require_once '../views/layout/footer.php'; ?>