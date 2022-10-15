<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Entities\User;


class UserModel extends Model
{
    protected $table = "user";
    protected $allowedFields = ["name", "password","email","activation_hash","is_active", "user_image"]; //allow modify columns
    protected $useTimestamps = true; //get date automatcly
    protected $returnType    = \App\Entities\User::class; //ussing entities
    protected $validationRules = [
        'name'     => 'required|min_length[3]',
        'email'        => 'required|valid_email|is_unique[user.email]',
        'password'     => 'required|min_length[6]',
    ];
    protected $validationMessages = [
        'name' => [
            'required' => 'please enter name',
            'min_length' => 'please enter more than 3 characters'
            
        ],
        'email' => [
            'required' => 'please enter email',
            'valid_email' => 'email not validate',
            'is_unique' => 'email not unique'
        ],
        'password' => [
            'required' => 'please enter password',
            'min_length' => 'please enter more than 6 characters'

        ]
    ];
}
