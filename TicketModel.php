<?php

namespace App\Models;

use CodeIgniter\Model;

class TicketModel extends Model
{
    protected $table = 'tickets';
    protected $primaryKey = 'ticket_id';

    protected $allowedFields = [
        'ticket_code',
        'reporter_name',
        'issue_title',
        'priority',
        'status',
        'assigned_tech_id',
        'parent_ticket_id',
        'deleted_at'
    ];

    protected $useSoftDeletes = true;
    protected $deletedField = 'deleted_at';
}