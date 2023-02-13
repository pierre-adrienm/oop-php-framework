<?php

namespace App\Controllers\Admin;

use App\Controllers\Controller;
use App\Models\Post;
use App\Models\Tag;

class PostController extends Controller {

    /**
     * Summary of index
     * @return void
     */
    public function index()
    {
        // verifirer si on est connectée en tant qu'administrateur
        $this->isAdmin();

        $posts = (new Post($this->getDB()))->all();

        return $this->view('admin.post.index', compact('posts'));
    }

    /**
     * Summary of create
     * @return void
     */
    public function create()
    {
        // verifirer si on est connectée en tant qu'administrateur
        $this->isAdmin();

        $tags = (new Tag($this->getDB()))->all();

        return $this->view('admin.post.form', compact('tags'));
    }

    /**
     * Summary of createPost
     * @return void
     */
    public function createPost()
    {
        // verifirer si on est connectée en tant qu'administrateur
        $this->isAdmin();

        // créer un nouveau post
        $post = new Post($this->getDB());

        $tags = array_pop($_POST);

        $result = $post->create($_POST, $tags);

        if ($result) {
            return header('Location:'.HREF_ROOT.'admin/posts');
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
       // verifirer si on est connectée en tant qu'administrateur
        $this->isAdmin();

        // créer une nouvelle instant de post et de tag
        $post = (new Post($this->getDB()))->findById($id);
        $tags = (new Tag($this->getDB()))->all();
        
        //var_dump("Model edit:", $post);
        //var_dump("Model edit:", $tags);
        // retourner le résulta de la vue de post et de tags
        return $this->view('admin.post.form', compact('post', 'tags'));
        //return $this->view('admin.post.form', compact('post'));
    }

    /**
     * Summary of update
     * @param int $id
     * @return void
     */
    public function update(int $id)
    {
        // verifirer si on est connectée en tant qu'administrateur
        $this->isAdmin();

        // créer une nouvelle instance de post
        $post = new Post($this->getDB());

        // var_dump("PostController update:",$_POST);
        // retourne de déplie la dernière valeur de $_POST et attribue à la variable $tags
        $tags = array_pop($_POST);
       // var_dump("PostController update:",$_POST, $tags);

        // modifie le post à modifier et attribue à la variable $post
        $result = $post->update($id, $_POST, $tags);

        // si c'est modifier retourne le résultat sur la page 'admin/posts'
        if ($result) {
            return header('Location: '.HREF_ROOT.'admin/posts');
        }
    }

    /**
     * Summary of destroy
     * @param int $id
     * @return void
     */
    public function destroy(int $id)
    {
        // verifirer si on est connectée en tant qu'administrateur
        $this->isAdmin();

        // créer une nouvelle instant de Post puis attribué le post à détruire sur la variable $post
        $post = new Post($this->getDB());
        $result = $post->destroy($id);

        // si c'est supprimé retourne le résultat sur la page 'admin/post'
        if ($result) {
            return header('Location: '.HREF_ROOT.'admin/posts');
        }
    }
}
