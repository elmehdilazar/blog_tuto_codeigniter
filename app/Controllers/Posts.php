<?php

namespace App\Controllers;

use App\Entities\Post;
use App\Models\PostModel;
use App\Models\UserModel;

class Posts extends BaseController

{
    private $data;
    private $user_id;

    public function __construct()
    {
        $this->data = new PostModel();
        $this->user_id = session("user_id");
    }
    public function index()
    {
        //mth 1 $posts=$this->data->where("user_id",$this->user_id)->findAll();
        //mth 2 function in model
        $posts = $this->data->getUsers($this->user_id);

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


        return view('posts/index', ["posts" => $posts, "name" => $this]);
    }

    public function show($id)

    {
        $page = $this->data->find($id);
        $owner = isset($page->user_id) ? $page->user_id === session("user_id") : false; //test id
        if (!$page) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("article $id not found");
        }
        return view('posts/show', ["posts" => $page, "owner" => $owner, "name" => $this->getUsers($page->user_id)]);
    }
    public function ajouter()
    {
        return view('posts/ajouter');
    }
    public function store()
    {
        $file = $this->request->getFile("post_image");

        //*test validation file
        if (!$file->isValid()) {
            $error_code = $file->getError();
            if ($error_code === UPLOAD_ERR_NO_FILE) {
                return    redirect()->back()->with("errors", "no file uploaded ")->withInput();
            }
        }
        //*test size file
        $size =  $file->getSizeByUnit('mb');
        if ($size > 2) {

            return    redirect()->back()->with("errors", "size is large !!!!! ")->withInput();
        }
        //*test extation type file
        $type =  $file->getMimeType();
        $ext = ["image/png", "image/jpg", "image/jpeg"];
        if (!in_array($type, $ext)) {
            return    redirect()->back()->with("errors", "extation no valid ")->withInput();
        }
        //*file upload
        //    move_uploaded_file($file->getTempName(),WRITEPATH."/uploads/imagepost/".$file->getRandomName());
        $file->move("post_img",$file->getRandomName());
        $post = new Post(esc($this->request->getPost()));
        $post->user_id =  $this->user_id;
        $post->post_image = $file->getName();
        //add user id
        $add = $this->data->insert($post);
        //  with request
        //  $add= $data->insert([
        //         "title"=>esc($this->request->getPost('title')),
        //         "description"=>esc($this->request->getPost('description'))


        //     ]);

        if ($add) {
            return  redirect()->to("posts/index")->with("success", "article added on successfuly");
        } else {
            return    redirect()->back()->with("errors", "post not added");
        }
    }

    public function editer($id)
    {
        $page = $this->data->find($id);
        if ($page->user_id === session("user_id")) {
            if (!$page) {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("article $id not found");
            }

            return view('posts/editer', ["post" => $this->data->find($id)]);
        } else {
            return  redirect()->to("/");
        }
    }
    public function update($id)
    {

        // WITH REQUEST
        // $updated = $data->update($id,[
        //     "title" => esc($this->request->getPost('title')),
        //     "description" => esc($this->request->getPost('description'))


        // ]);

        // if ($updated) {
        //     return  redirect()->to("posts/index")->with("success", "article updated on successfuly");
        // } else {
        //     return    redirect()->back()->with("errors", "error post not updated ")->withInput();
        // }
        $post = $this->data->find($id);
        if ($post->user_id === session("user_id")) :
            $post->fill(esc($this->request->getPost()));
            if ($post->hasChanged('title') || $post->hasChanged('description')) { //has changed la tebdlo les champs
                if ($this->data->save($post)) {
                    return  redirect()->to("posts/index")->with("success", "article updated on successfuly");
                } else {
                    return    redirect()->back()->with("errors", "error post not updated ")->withInput();
                }
            } else {

                return    redirect()->back()->with("warrning", "no  modification !!!")->withInput();
            }
        else :
            return  redirect()->to("/");
        endif;
    }
    public function delete($id)
    {
        $id = esc($id);
        $post = $this->data->find($id);

        if ($post->user_id === session("user_id")) :
            if (!$post) {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("article $id not found");
            } else {
                $this->data->delete($id);
                return redirect()->to("posts/index")->with("success", "article deleted on successfuly");
            }
        else :
            return  redirect()->to("/");
        endif;
    }
    private function uploadPostImage()
    {
       
        $file = $this->request->getFile("post_image");


        if (!$file->isValid()) {
            $error_code = $file->getError();
            if ($error_code === UPLOAD_ERR_NO_FILE) {
                return    redirect()->back()->with("errors", "no file uploaded ")->withInput();
            }
        }
        $size =  $file->getSizeByUnit('mb');
        if ($size > 2) {

            return    redirect()->back()->with("errors", "size is large !!!!! ")->withInput();
        }
        $type =  $file->getMimeType();
        $ext = ["image/png", "image/jpg", "image/jpeg"];
        if (!in_array($type, $ext)) {
            return    redirect()->back()->with("errors", "extation no valid ")->withInput();
        }

                //    move_uploaded_file($file->getTempName(),WRITEPATH."/uploads/imagepost/".$file->getRandomName());
                $file->store("./post_img");
    }
    public function getUsers($id)
    {   
        $user= new UserModel();
        $user=$user->find($id);
        return $user->name;
    }
}
