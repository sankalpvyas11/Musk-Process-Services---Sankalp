<?php

namespace App\Models;

use CodeIgniter\Model;

class CategoryModel extends Model
{
    protected $table      = 'category_inspection';
    protected $primaryKey = 'category_id';

    protected $returnType     = 'App\Entities\CategoryEntity';

    protected $allowedFields = ['category_name'];

    protected $useTimestamps = true;

    protected $validationRules    = [
        'category_name' => 'required'
    ];
    protected $validationMessages = [
        'category_name' => [
            'required' => 'Please enter a category name'
        ]
    ];
    protected $skipValidation     = false;
}