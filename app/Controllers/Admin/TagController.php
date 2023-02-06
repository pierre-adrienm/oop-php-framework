<?php

namespace App\Controllers\Admin;

use App\Controllers\Controller;
use App\Models\Tag;
use App\Models\Post;

class TagController extends Controller{

    /**
     * Summary of Create
     * @return void
     */
    public function Create()
    {
        $this->isAdmin();

        $tags = (new Tag($this->getDB()))->all();

        return $this->view('admin.post.form', compact('tags'));
    }

    /**
     * Summary of CreateTag
     * @return void
     */
    public function CreateTag()
    {
        $this->isAdmin();

        $tag = new Post($this->getDB());

        $tags = array_pop($_POST);

        $result = $tag->create($_POST, $tags);

        if ($result) {
            return header('Location:'.HREF_ROOT.'admin/tag');
        }
    }

    public function ReadTag()
    {
        
    }

    public function UdpateTag(string $nom)
    {

    }

    public function DelateTag(string $nom)
    {

    }
}
