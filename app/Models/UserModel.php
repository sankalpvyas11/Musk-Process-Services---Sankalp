<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table      = 'user';
    protected $primaryKey = 'user_id';

    protected $returnType     = 'App\Entities\UserEntity';

    protected $allowedFields = ['name', 'password', 'email', 'role_id', 'token_pwd'];

    protected $useTimestamps = true;

    protected $validationRules    = [
       'name' => 'required',
       'email' => 'required|valid_email|is_unique[user.email]',
       'password' => 'required|min_length[6]', 
       'password_confirmation' => 'required|matches[password]'
    ];

    protected $validationMessages = [
        'email' => [
            'is_unique' => 'That email adress is taken'
        ],
        'password_confirmation' => [
            'required' => 'Please confirm the password',
            'matches' => 'Please enter the same password again'
        ]
    ];
    protected $skipValidation     = false;

    protected $beforeInsert = ['hashPassword'];


    protected function hashPassword(array $data)
    {
        if (isset($data['data']['password'])){
            $data['data']['password'] = password_hash($data['data']['password'], PASSWORD_DEFAULT);
        }
        return $data;
    }
}