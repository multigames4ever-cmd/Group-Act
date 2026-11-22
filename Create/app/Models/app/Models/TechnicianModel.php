
<?php

namespace App\Models;

use CodeIgniter\Model;

class TechnicianModel extends Model
{
    protected $table = 'technicians';
    protected $primaryKey = 'tech_id';

    protected $returnType = 'array';

    protected $allowedFields = [
        'tech_name',
        'specialization',
        'is_active'
    ];
}