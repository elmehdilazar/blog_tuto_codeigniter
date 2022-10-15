<?php

namespace App\Models;

use CodeIgniter\Model;


class PostModel extends Model
{
    protected $table="post";
   protected $allowedFields=["title","description","user_id","post_image"]; //allow modify columns
    protected $useTimestamps = true; //get date automatcly
    protected $returnType    = \App\Entities\Post::class; //ussing entities
    protected $validationRules = [
        'title'     => 'required|min_length[5]',
        'description' => 'required|min_length[6]',
    ];
    protected $validationMessages = [
        'title' => [
            'required' => 'title not validate',
        ],
        'description' => [
            'required' => 'description not validate',
        ]
    ];
    public function getUsers($user_id)
    {
        return $this->where("user_id", $user_id)->orderBy("created_at","DESC")->findAll();
    }
}
