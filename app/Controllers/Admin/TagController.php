<?php

namespace App\Controllers\Admin;

use App\Controllers\Controller;
use App\Models\Tag;


class TagController extends Controller{


    public function index()
    {
        // verifirer si on est connectée en tant qu'administrateur
        $this->isAdmin();

        // créer un nouveau instance tag et tous indexer
        $tags = (new Tag($this->getDB()))->all();

        // retourne le résultat de l'affiche sur 'admin.tags.index'
        return $this->view('admin.tags.index', compact('tags'));
    }

    /**
     * Summary of Create
     * @return void
     */
    public function create()
    {
        // verifirer si on est connectée en tant qu'administrateur
        $this->isAdmin();

        // créer un nouveau instance tag et tous indexer
        $tags = (new Tag($this->getDB()))->all();

        // retourne le résultat de l'affiche sur 'admin.tags.form'
        return $this->view('admin.tags.form');
    }

    /**
     * Summary of CreateTag
     * @return void
     */
    public function createTag()
    {
        // verifirer si on est connectée en tant qu'administrateur
        $this->isAdmin();

        // créer un nouveau instance de tag
        $tag = new Tag($this->getDB());

        // $tags = array_pop($_POST);

        // récréer un tag est l'attribué sur la variable $result
        $result = $tag->create($_POST);

        // si le tag est créer retourner le résultat sur 'admin/tags'
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
       // verifirer si on est connectée en tant qu'administrateur 
       $this->isAdmin();

        // créer un nouveau instance de tag est retourver pour un id
        $tags = (new Tag($this->getDB()))->findById($id);
        
        //var_dump("Model edit:", $post);
        //var_dump("Model edit:", $tags);
        // retourner le vue des tags sur 'admin.tags.form'
        return $this->view('admin.tags.form', compact('tags'));
    }

    /**
     * Summary of UdpateTag
     * @param int $id
     * @return void
     */
    public function update(int $id)
    {
        // verifirer si on est connectée en tant qu'administrateur
        $this->isAdmin();

        // créer un nouveau instant de tag
        $tags = new Tag($this->getDB());

        // var_dump("PostController update:",$_POST);
       // var_dump("PostController update:",$_POST, $tags);

        // mondifier le tags est attribée à la variable $result
        $result = $tags->update($id, $_POST);

        // si le tags est modifier retourner le résultat sur 'admin/tags'
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
        // verifirer si on est connectée en tant qu'administrateur
        $this->isAdmin();

        // créer un nouveau instance tags
        $tag = new Tag($this->getDB());
        // supprimer le tags est attribué à la variable $result
        $result = $tag->destroy($id);

        // si le tags est supprimer retourner le résultat sur 'admin/tags"
        if ($result) {
            return header('Location: '.HREF_ROOT.'admin/tags');
        }
    }
}
