<!-- app/Views/tickets/edit.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Ticket</title>
</head>
<body>
    <h2>Edit Ticket <?= esc($ticket['ticket_code']) ?></h2>


    <?php if (session()->getFlashdata('error')): ?>
        <p style="color:red"><?= esc(session()->getFlashdata('error')) ?></p>
    <?php endif; ?>


    <form action="<?= site_url('tickets/' . $ticket['ticket_id']) ?>" method="post">
        <?= csrf_field() ?>
        <input type="hidden" name="_method" value="PUT">
        <div>
            <label for="issue_title">Issue Title</label><br>
            <input type="text" id="issue_title" name="issue_title" value="<?= esc(old('issue_title', $ticket['issue_title'])) ?>">
        </div>
        <div>
            <label for="priority">Priority</label><br>
            <select id="priority" name="priority">
                <?php foreach (['Low', 'Medium', 'High', 'Critical'] as $p): ?>
                    <option value="<?= $p ?>" <?= old('priority', $ticket['priority']) === $p ? 'selected' : '' ?>><?= $p ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div>
            <label for="status">Status</label><br>
            <select id="status" name="status">
                <?php foreach (['Open', 'In Progress', 'Resolved', 'Closed'] as $s): ?>
                    <option value="<?= $s ?>" <?= old('status', $ticket['status']) === $s ? 'selected' : '' ?>><?= $s ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div>
            <label for="assigned_tech_id">Assigned Technician</label><br>
            <select id="assigned_tech_id" name="assigned_tech_id">
                <option value="">-- Unassigned --</option>
                <?php foreach ($technicians as $tech): ?>
                    <option value="<?= $tech['tech_id'] ?>" <?= (string) old('assigned_tech_id', $ticket['assigned_tech_id']) === (string) $tech['tech_id'] ? 'selected' : '' ?>>
                        <?= esc($tech['tech_name']) ?> (<?= esc($tech['specialization']) ?>)
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div>
            <label for="parent_ticket_id">Parent Ticket</label><br>
            <select id="parent_ticket_id" name="parent_ticket_id">
                <option value="">-- None --</option>
                <?php foreach ($parents as $p): ?>
                    <option value="<?= $p['ticket_id'] ?>" <?= (string) old('parent_ticket_id', $ticket['parent_ticket_id']) === (string) $p['ticket_id'] ? 'selected' : '' ?>>
                        <?= esc($p['ticket_code']) ?> - <?= esc($p['issue_title']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <button type="submit">Update</button>
    </form>
</body>
</html>
