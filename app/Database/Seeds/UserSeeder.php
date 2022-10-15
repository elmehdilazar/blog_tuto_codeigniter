<?php

namespace App\Database\Seeds;

use App\Models\UserModel;
use CodeIgniter\Database\Seeder;
// use CodeIgniter\Model;

class UserSeeder extends Seeder
{
    public function run()
    {
        $model=new UserModel();
        $model->protect(false);
        $model->insert([
            'email'=>"admin@gmail.com",
            'name'=>"admin",
            'password'=>password_hash("admin123",PASSWORD_DEFAULT),
            'is_admin'=>1,
            'is_active'=>1,
        ]);
    }
}
