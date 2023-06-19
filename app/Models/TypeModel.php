<?php

namespace App\Models;

use CodeIgniter\Model;

class TypeModel extends Model
{
    protected $table      = 'type';
    protected $primaryKey = 'type_id';

    protected $returnType     = 'App\Entities\TypeEntity';

    protected $allowedFields = ['type_name'];

    protected $useTimestamps = true;

    protected $validationRules    = [
        'type_name' => 'required'
    ];
    protected $validationMessages = [
        'type_name' => [
            'required' => 'Please enter a type name'
        ]
    ];
    protected $skipValidation     = false;
}