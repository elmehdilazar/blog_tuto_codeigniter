<?php

namespace App\Controllers\admin;

use App\Models\UserModel;

class Users extends \App\Controllers\BaseController
{
    private $data;
    public function __construct()
    {
        $this->data = new UserModel();
    }
    public function index()
    {
        return view('admin/users/index', [
            "users" => $this->data->orderBy("id", "desc")->paginate(5), //che7al mn post fe page
            "pager" => $this->data->pager //hada kay sift lien deyal les page
        ]);
    }
    public function delete($id)
    {
        $id = esc($id);
        $user = $this->data->find($id);

        if (session("admin")) :
            if (!$user) {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("user $id not found");
            } else {
                if ($id !== session("user_id")) {
                    $this->data->delete($id);
                    return redirect()->to("admin/users/index")->with("success", "user deleted on successfuly");
                } else {
                    return redirect()->back()->with("warrning", "you can't delete your self");
                }
            }
        else :
            return  redirect()->to("/");
        endif;
    }
    public function update($id)
    {
        $id = esc($id);
        $user = $this->data->find($id);
        if(isset($user->is_admin)){
               if($user->is_admin){
                    $msg = "admin removed on successfuly";
                    $isadmin=0;
        }else{
            $msg = "admin added on successfuly";
            $isadmin = 1;
        }
        }else{
            $msg = "admin added on successfuly";
            $isadmin = 1; 
        }
     
        if (session("admin")) {
            $this->data->protect(false);
            if (!$user) {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("user $id not found");
            }else{
                if ($id !== session("user_id")):
                 if (
                $this->data->update(
                    $id,
                    ["is_admin" => $isadmin]
                )

            ) {
                return redirect()->to("admin/users/index")->with("success",$msg);

            } else {
                    return redirect()->back()->with("errors", $this->data->errors());
            }
        else:
                    return redirect()->back()->with("warrning", "you can't modify your self");
        endif;
            }
           
        } else {

            return  redirect()->to("/");
        }
    }

    public function Active($id)
    {
        $$id = esc($id);
        $user = $this->data->find($id);
        if (isset($user->is_admin)) {
            if ($user->is_active) {
                $msg = "user disabled on successfuly";
                $isactive = 0;
            } else {
                $msg = "user actived on successfuly";
                $isactive = 1;
            }
        } else {
            $msg = "user actived on successfuly";
            $isactive = 1;
        }

        if (session("admin")) {
            $this->data->protect(false);
            if (!$user) {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("user $id not found");
            } else {
                if ($id !== session("user_id")) :
                    if (
                        $this->data->update(
                            $id,
                            ["is_active" => $isactive]
                        )

                    ) {
                        return redirect()->to("admin/users/index")->with("success", $msg);
                    } else {
                        return redirect()->back()->with("errors", $this->data->errors());
                    }
                else :
                    return redirect()->back()->with("warrning", "you can't modify your self");
                endif;
            }
        } else {

            return  redirect()->to("/");
        }
    }
}
