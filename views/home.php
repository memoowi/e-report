<?php
$page_title = 'Home';
require_once '../views/layout/header.php';
require_once '../helpers/auth_helper.php';
requireAuth();
?>

<main>
    <h2>Welcome, <span><?php echo $_SESSION['user']['name']; ?></span></h2>

    <section>
        <h3>Create a Report</h3>
        <p>Report your problems here.</p>
        <a class="btn" href="<?= url('report_create'); ?>">
            Create Report &nbsp;
            <i class="fas fa-plus"></i>
        </a>
    </section>

    <section>
        <h3>Recent Reports</h3>
        <p>Here are your recent reports.</p>
        <table>
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th>Created At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <!-- <?php foreach ($reports as $report): ?>
                    <tr>
                        <td><?= $report['title']; ?></td>
                        <td><?= $report['description']; ?></td>
                        <td><?= $report['created_at']; ?></td>
                        <td>
                            <a class="btn edit-btn" href="<?= url('edit', ['id' => $report['id']]); ?>">Edit</a>
                            <a class="btn delete-btn" href="<?= url('delete', ['id' => $report['id']]); ?>">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?> -->
            </tbody>
        </table>
    </section>
</main>

<?php require_once '../views/layout/footer.php'; ?>