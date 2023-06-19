<?php

namespace App\Models;

use CodeIgniter\Model;

class InspectionModel extends Model
{
    protected $table      = 'inspection';
    protected $primaryKey = 'inspection_id';

    protected $returnType     = 'App\Entities\InspectionEntity';

    protected $allowedFields = ['site_id', 'job_description', 'work_area', 'inspection_supervisor', 'inspection_inspector', 'date', 'type_id', 'user_id', 'manager_id'];

    protected $useTimestamps = true;

    protected $validationRules    = [
        'job_description' => 'required',
        'work_area' => 'required'
    ];
    protected $validationMessages = [
        'job_description' => [
            'required' => 'Please enter a job description'
        ],
        'work_area' => [
            'required' => 'Please enter a work area'
        ]
    ];
    protected $skipValidation     = false;
}