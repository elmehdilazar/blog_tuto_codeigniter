<?php

namespace App\Controllers\admin;

use App\Models\PostModel;

class Posts extends \App\Controllers\BaseController
{
    private $data;
    public function __construct()
    {
        $this->data = new PostModel();
    }
    public function index()
    {
        return view('admin/posts/index', [
            "posts" => $this->data->orderBy("created_at", "desc")->paginate(5), //che7al mn post fe page
            "pager" => $this->data->pager //hada kay sift lien deyal les page
        ]);
    }
    public function delete($id)
    {
        $id = esc($id);
        $post = $this->data->find($id);

        if (session("admin")) :
            if (!$post) {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("post $id not found");
            } else {
                $this->data->delete($id);
                return redirect()->to("admin/posts/index")->with("success", "post deleted on successfuly");
            }
        else :
            return  redirect()->to("/");
        endif;
    }
}
