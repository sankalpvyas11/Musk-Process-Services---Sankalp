<?php

namespace App\Models;

use CodeIgniter\Model;

class SiteModel extends Model
{
    protected $table      = 'site';
    protected $primaryKey = 'site_id';

    protected $returnType     = 'App\Entities\SiteEntity';

    protected $allowedFields = ['site_name'];

    protected $useTimestamps = true;

    protected $validationRules    = [
        'site_name' => 'required'
    ];
    protected $validationMessages = [
        'site_name' => [
            'required' => 'Please enter a site name'
        ]
    ];
    protected $skipValidation     = false;
}