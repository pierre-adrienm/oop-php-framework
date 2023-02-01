<?php

namespace App\Controllers;

use App\Models\Post;
use App\Models\Tag;

class BlogController extends Controller {

    /**
     * Summary of welcome
     * @return void
     */
    public function welcome()
    {
        return $this->view('blog.welcome');
    }

    /**
     * Summary of index
     * @return void
     */
    public function index()
    {
        $post = new Post($this->getDB());
        $posts = $post->all();

        return $this->view('blog.index', compact('posts'));
    }

    /**
     * Summary of show
     * @param int $id
     * @return void
     */
    public function show(int $id)
    {
        $post = new Post($this->getDB());
        $post = $post->findById($id);

        return $this->view('blog.show', compact('post'));
    }

    /**
     * Summary of tag
     * @param int $id
     * @return void
     */
    public function tag(int $id)
    {
        $tag = (new Tag($this->getDB()))->findById($id);

        return $this->view('blog.tag', compact('tag'));
    }
}
