<?php

namespace App\Controllers;

use App\Entities\User;
use App\Models\UserModel;

class Register extends BaseController

{
    private $data;


    public function __construct()
    {
        $this->data = new UserModel();
    }
    public function registerForm()

    {

        return view('users/register');
    }
    public function store()

    {
        $file = $this->request->getFile("img_user");
        if (!$file->isValid()) {
            $erreur = $file->getError();
            if ($erreur === UPLOAD_ERR_NO_FILE) {
                return    redirect()->back()->with("errors", "no file uploaded ")->withInput();
            }
        }
        $size = $file->getSizeByUnit('mb');
        if ($size > 2) {
            return    redirect()->back()->with("errors", "file is large ")->withInput();
        }
        $type = $file->getMimeType();
        $ext = ["image/jpg", "image/jpeg", "image/gif", "image/png"];
        if (!in_array($type, $ext)) {
            return    redirect()->back()->with("errors", "extanche not valide ")->withInput();
        }
        $newName = $file->getRandomName();
        $file->move('uers_post', $newName);





        $user = new User(esc($this->request->getPost()));
        if (strlen($user->password) >= 6) {
            $user->password = password_hash($user->password, PASSWORD_DEFAULT);
        }
         $user->user_image=$file->getName();
        $user->activation_hash();
        $add = $this->data->insert($user);

        if ($add) {
            $this->emailChek($user);
            return  redirect()->to("/posts/index")->with("success", "you're registred on successfuly");
        } else {
            return    redirect()->back()->with("error", $this->data->errors())->withInput();
        }
    }
    public function  emailChek($user)
    {
        $email = \Config\Services::email();
        $email->setFrom('midomidomido@gmail.com', 'codeigniter');
        $email->setTo($user->email);
        $email->setSubject('Activation_account');
        $message = view("email/activation_account", ["hash" => $user->activation_hash]);
        $email->setMessage($message);
        $email->send();
    }
    public function activateAccount($token)
    {
        $user = $this->data->where('activation_hash', $token)->first();
        if (!$user) {
            return    redirect()->back()->with("errors", "activation faild")->withInput();
        }
        $this->data->protect(false);
        $user->activation_hash = null;
        $user->is_active = 1;
        $this->data->save($user);
        return view("email/account_activated");
    }
}
