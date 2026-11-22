
<!DOCTYPE html>
<html>
<head>
    <title>Archived Tickets</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
          rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-5">

    <h2>Archived Tickets</h2>
    <p>Deleted and archived support tickets</p>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success">
            <?= esc(session()->getFlashdata('success')) ?>
        </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger">
            <?= esc(session()->getFlashdata('error')) ?>
        </div>
    <?php endif; ?>

    <a href="<?= base_url('tickets') ?>"
       class="btn btn-primary mb-3">
        Back to Tickets
    </a>

    <table class="table table-bordered table-striped bg-white">

        <thead class="table-dark">
            <tr>
                <th>Ticket Code</th>
                <th>Reporter</th>
                <th>Issue</th>
                <th>Priority</th>
                <th>Status</th>
                <th>Deleted At</th>
                <th>Actions</th>
            </tr>
        </thead>

        <tbody>

        <?php if (!empty($tickets)): ?>

            <?php foreach ($tickets as $ticket): ?>

                <tr>
                    <td><?= esc($ticket['ticket_code']) ?></td>
                    <td><?= esc($ticket['reporter_name']) ?></td>
                    <td><?= esc($ticket['issue_title']) ?></td>
                    <td><?= esc($ticket['priority']) ?></td>
                    <td><?= esc($ticket['status']) ?></td>
                    <td><?= esc($ticket['deleted_at']) ?></td>

                    <td>

                        <!-- RESTORE -->
                        <form action="<?= base_url('tickets/restore/' . $ticket['ticket_id']) ?>"
                              method="post"
                              class="mb-2">

                            <?= csrf_field() ?>

                            <button type="submit"
                                    class="btn btn-success btn-sm">
                                Restore
                            </button>

                        </form>

                        <!-- PERMANENT DELETE -->
                        <form action="<?= base_url('tickets/force-delete/' . $ticket['ticket_id']) ?>"
                              method="post"
                              onsubmit="return confirm('Permanently delete this ticket?')">

                            <?= csrf_field() ?>

                            <button type="submit"
                                    class="btn btn-danger btn-sm">
                                Delete Permanently
                            </button>

                        </form>

                    </td>
                </tr>

            <?php endforeach; ?>

        <?php else: ?>

            <tr>
                <td colspan="7" class="text-center">
                    No archived tickets found.
                </td>
            </tr>

        <?php endif; ?>

        </tbody>

    </table>

</div>

</body>
</html>