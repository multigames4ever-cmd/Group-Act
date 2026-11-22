
<?php

namespace App\Models;

use CodeIgniter\Model;

class TicketModel extends Model
{
    protected $table = 'tickets';
    protected $primaryKey = 'ticket_id';

    protected $useAutoIncrement = true;
    protected $returnType = 'array';

    protected $allowedFields = [
        'ticket_code',
        'reporter_name',
        'issue_title',
        'priority',
        'status',
        'assigned_tech_id',
        'parent_ticket_id'
    ];

    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    // CI4 Soft Deletes
    protected $useSoftDeletes = true;
    protected $deletedField = 'deleted_at';
}