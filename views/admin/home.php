<?php
$page_title = 'Admin Home';
require_once '../views/layout/header.php';
require_once '../helpers/date_helper.php';
?>

<main>
    <h2>Welcome, <span><?php echo $_SESSION['user']['name']; ?></span></h2>

    <!-- <section>
        <h3>Create a Report</h3>
        <p>Report your problems here.</p>
        <a class="btn" href="<?= url('report-create'); ?>">
            Create Report &nbsp;
            <i class="fas fa-plus"></i>
        </a>
    </section> -->

    <section>
        <h3>All Reports</h3>
        <p>Here are all recent reports.</p>
        <table>
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th>Created At</th>
                    <th>Updated At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (empty($reports)) {
                    echo '<tr ><td colspan="6" class="no-reports">No reports found.</td></tr>';
                } else {
                    foreach ($reports as $report):
                ?>
                        <tr>
                            <td><?= $report['title']; ?></td>
                            <td><?= $report['description']; ?></td>
                            <td><?= $report['status']; ?></td>
                            <td><?= format_date($report['created_at']) ?></td>
                            <td><?= format_date($report['updated_at']) ?></td>
                            <td class="actions">
                                <a class="btn view-btn" href="<?= url('report-view', ['id' => $report['id']]); ?>">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a class="btn edit-btn" href="<?= url('report-edit', ['id' => $report['id']]); ?>">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <!-- <a class="btn delete-btn" href="<?= url('report-delete', ['id' => $report['id']]); ?>">
                                    <i class="fas fa-trash"></i>
                                </a> -->
                            </td>
                        </tr>
                <?php endforeach;
                } ?>
            </tbody>
        </table>
    </section>
</main>

<?php require_once '../views/layout/footer.php'; ?>