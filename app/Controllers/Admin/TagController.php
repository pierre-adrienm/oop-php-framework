<?php

namespace App\Controllers\Admin;

use App\Controllers\Controller;
use App\Models\Tag;
use App\Models\Post;

class TagController extends Controller{


    public function index()
    {
        $this->isAdmin();

        $tags = (new Tag($this->getDB()))->all();

        return $this->view('admin.tags.index', compact('tags'));
    }

    /**
     * Summary of Create
     * @return void
     */
    public function create()
    {
        $this->isAdmin();

        $tags = (new Tag($this->getDB()))->all();

        return $this->view('admin.tags.form', compact('tags'));
    }

    /**
     * Summary of CreateTag
     * @return void
     */
    public function createTag()
    {
        $this->isAdmin();

        $tag = new Tag($this->getDB());

        // $tags = array_pop($_POST);

        $result = $tag->create($_POST);

        if ($result) {
            return header('Location:'.HREF_ROOT.'admin/tags');
        }
    }

    /**
     * Summary of edit
     * @param int $id
     * @return void
     */
    public function edit(int $id)
    {
       // var_dump("Model edit:", $id);
        $this->isAdmin();

        $tags = (new Tag($this->getDB()))->all();
        
        //var_dump("Model edit:", $post);
        //var_dump("Model edit:", $tags);
        return $this->view('admin.tags.form', compact('tags'));
    }

    /**
     * Summary of UdpateTag
     * @param int $id
     * @return void
     */
    public function update(int $id)
    {
        $this->isAdmin();

        $tag = new Tag($this->getDB());

        // var_dump("PostController update:",$_POST);
        $tags = array_pop($_POST);
       // var_dump("PostController update:",$_POST, $tags);

        $result = $tag->update($id, $_POST, $tags);

        if ($result) {
            return header('Location: '.HREF_ROOT.'admin/tags');
        }
    }

    /**
     * Summary of DelateTag
     * @param int $id
     * @return void
     */
    public function destroy(int $id)
    {
        $this->isAdmin();

        $tag = new Tag($this->getDB());
        $result = $tag->destroy($id);

        if ($result) {
            return header('Location: '.HREF_ROOT.'admin/tags');
        }
    }
}
