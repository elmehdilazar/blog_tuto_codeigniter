<?php

namespace App\Controllers;

use App\Entities\User;
use App\Models\UserModel;

class Login extends BaseController

{
    private $data;


    public function __construct()
    {
        $this->data = new UserModel();
    }
    public function loginForm()

    {
     
            return view('users/login');
      
    }
    public function auth()
    {

        $email = $this->request->getPost("email");
        $password = $this->request->getPost("password");
        $user = $this->data->where('email', $email)->first(); //find with where and get first
        if ($user !== null) {
            if (password_verify($password, $user->password)) {
                if($user->is_active==1){

                    $session = session(); //cree la sesstion
                    $session->regenerate(); // regération de id
                    $session->set('logged', true); //set variable session
                    $session->set('name', $user->name);
                    $session->set('user_id', $user->id);
                    $session->set('admin', $user->is_admin);
    
    
                    return  redirect()->to("/")
                        ->with("success", "you're connected");
                }
                else{

                    return  redirect()->back()
                    ->with("errors", "acitivate you're account");
                }
               
            } else {
                return    redirect()->back()
                    ->with("errors", "password faild !!!!")
                    ->withInput();
            }
        } else {
            return    redirect()->back()
                ->with("errors", "login faild !!!!")
                ->withInput();
        }
    }
    public function logout()
    {
        session()->destroy();
        return  redirect()->to("/");
    }
}
