
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Support Ticket</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">

    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h4>Create New Support Ticket</h4>
        </div>

        <div class="card-body">

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

            <?php if (session()->getFlashdata('errors')): ?>
                <div class="alert alert-danger">
                    <?php foreach (session()->getFlashdata('errors') as $error): ?>
                        <p><?= esc($error) ?></p>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <form action="<?= site_url('tickets/store') ?>" method="post">

                <?= csrf_field() ?>

                <div class="mb-3">
                    <label class="form-label">Reporter Name</label>
                    <input type="text"
                           name="reporter_name"
                           class="form-control"
                           value="<?= old('reporter_name') ?>"
                           maxlength="100"
                           required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Issue Title</label>
                    <input type="text"
                           name="issue_title"
                           class="form-control"
                           value="<?= old('issue_title') ?>"
                           maxlength="150"
                           required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Priority</label>
                    <select name="priority" class="form-select" required>
                        <option value="Low">Low</option>
                        <option value="Medium" selected>Medium</option>
                        <option value="High">High</option>
                        <option value="Critical">Critical</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Assigned Technician</label>
                    <select name="assigned_tech_id" class="form-select">
                        <option value="">Unassigned</option>

                        <?php foreach ($technicians as $tech): ?>
                            <option value="<?= $tech['tech_id'] ?>">
                                <?= esc($tech['tech_name']) ?>
                                - <?= esc($tech['specialization']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">
                        Parent Ticket (Optional)
                    </label>

                    <select name="parent_ticket_id" class="form-select">
                        <option value="">No Parent Ticket</option>

                        <?php foreach ($tickets as $ticket): ?>
                            <option value="<?= $ticket['ticket_id'] ?>">
                                <?= esc($ticket['ticket_code']) ?>
                                - <?= esc($ticket['issue_title']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>

                    <small class="text-muted">
                        Select an existing ticket if this is a related incident.
                    </small>
                </div>

                <button type="submit" class="btn btn-primary">
                    Submit Ticket
                </button>

                <a href="<?= site_url('tickets/create') ?>"
                   class="btn btn-secondary">
                    Cancel
                </a>

            </form>

        </div>
    </div>

</div>

</body>
</html>