<?php

namespace App\Controllers;


use App\Models\PostModel;
use App\Models\UserModel;

class Home extends BaseController
{
    private $data;
    public function __construct()
    {
        $this->data = new PostModel();
    }
    public function index()
    {

        //  [
        //     [
        //         "id" => '1',
        //         "title" => 'post 1',
        //         "desc" => 'description 1'
        //     ],
        //     [
        //         "id" => '2',
        //         "title" => 'post 2',
        //         "desc" => 'description 2'
        //     ],
        //     [
        //         "id" => '3',
        //         "title" => 'post 3',
        //         "desc" => 'description 3'
        //     ],

        // ];


        return view('home/index', [
            "posts" => $this->data->orderBy("created_at", "desc")->paginate(3),//che7al mn post fe page
            "pager" => $this->data->pager,//hada kay sift lien deyal les page
            "controler" => $this//his hiya class
        
        ]);
    }
    public function getUsers($id)
    {
        $user = new UserModel();
        $user = $user->find($id);
        return $user->name;
    }
   
}