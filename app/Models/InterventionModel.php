<?php

namespace App\Models;

use CodeIgniter\Model;

class InterventionModel extends Model
{
    protected $table      = 'intervention';
    protected $primaryKey = 'intervention_id';

    protected $returnType     = 'App\Entities\InterventionEntity';

    protected $allowedFields = ['intervention_nb', 'comment', 'is_completed', 'action_taken', 'attachment', 'inspection_id', 'inspection_type_id'];

    protected $useTimestamps = true;

    protected $validationRules    = [
        
    ];
    protected $validationMessages = [
        
    ];
    protected $skipValidation     = false;
}