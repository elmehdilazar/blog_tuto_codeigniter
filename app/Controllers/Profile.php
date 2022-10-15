<?php

namespace App\Controllers;

use App\Models\UserModel;

class Profile extends BaseController
{
    private $data;
    private $user;
    private $user_id;
    public function __construct()
    {
        $this->data = new UserModel();
        $this->user = $this->data->find(session("user_id"));
        $this->user_id = session("user_id");
    }
    public function index()
    {
        $id = session("user_id");
        return view('users/profile', [
            "user" => $this->data->find($id)
        ]);
    }
    public function editProfileForm()
    {
        $users = $this->data->find($this->user_id);
        if ($users->id === session("user_id")) {
            if (!$users) {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("user $this->user_id not found");
            }

            return view('users/edit', ["users" => $users]);
        } else {
            return  redirect()->to("/");
        }
    }
    public function updateProfile()
    {

        if ($this->user->id === session("user_id")) :
            $this->user->fill(esc($this->request->getPost()));
            if ($this->user->hasChanged('name') || $this->user->hasChanged('email')) { //has changed la tebdlo les champs
                if ($this->data->save($this->user)) {
                    $session = session();
                    $session->set("name", $this->user->name);
                    return  redirect()->to("/profile")->with("success", "user updated on successfuly");
                } else {
                    return    redirect()->back()->with("errors", "error user not updated ")->withInput();
                }
            } else {

                return    redirect()->back()->with("warrning", "no  modification !!!")->withInput();
            }
        else :
            return  redirect()->to("/");
        endif;
    }
    public function editPassword()
    {
        $users = $this->data->find($this->user_id);
        if ($users->id === session("user_id")) {

            return view('users/editPassword');
        } else {
            return  redirect()->to("/");
        }
    }
    public function updatePassword()
    {
        if ($this->user->id === session("user_id")) {
            $password = $this->request->getPost('password');
            $password_new = $this->request->getPost('new_password');
            if (!password_verify($password, $this->user->password)) {
                return    redirect()->back()->with("errors", "password faild!! ")->withInput();
            }
            if ($this->data->update(
                $this->user_id,
                ["password" => password_hash($password_new, PASSWORD_DEFAULT)]


            )) {

                session_destroy();

                return  redirect()->to("/")->with("success", "password updated on successfuly");
            } else {
                return    redirect()->back()->with("errors", "error password not updated ")->withInput();
            }
        } else {

            return  redirect()->to("/");
        }
    }
}
