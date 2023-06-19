<?php

namespace App\Models;

use CodeIgniter\Model;

class InspectionTypeModel extends Model
{
    protected $table      = 'inspection_type';
    protected $primaryKey = 'inspection_type_id';

    protected $returnType     = 'App\Entities\InspectionTypeEntity';

    protected $allowedFields = ['inspection_type_name'];

    protected $useTimestamps = true;

    protected $validationRules    = [
        'inspection_type_name' => 'required'
    ];
    protected $validationMessages = [
        'inspection_type_name' => [
            'required' => 'Please enter an inpection type name'
        ]
    ];
    protected $skipValidation     = false;
}