<?php

namespace App\Controllers\Admin;

use App\Controllers\Controller;
use App\Models\Media;

class MediaController extends Controller
{
    
    /**
     * Summary of index
     * @return void
     */
    public function index()
    {
        // verifirer si on est connectée en tant qu'administrateur
        $this->isAdmin();

        $medias = (new Media($this->getDB()))->all();

        return $this->view('admin.medias.index', compact('medias'));
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
        $medias = (new Media($this->getDB()))->all();

        // retourne le résultat de l'affiche sur 'admin.medias.form'
        return $this->view('admin.medias.form');
    }

    /**
     * Summary of createMedia
     * @return void
     */
    public function createMedia()
    {
        // verifirer si on est connectée en tant qu'administrateur
        $this->isAdmin();

        // créer un nouveau media
        $medias = new Media($this->getDB());

        $result = $medias->create($_POST);

        if ($result) {
            return header('Location:'.HREF_ROOT.'admin/medias');
        }
    }

    /**
     * Summary of edit
     * @param int $id
     * @return void
     */
    public function edit(int $id)
    {
    	if(IS_DEBUG) var_dump('MediaCOntroller edit: ', $id);
       // var_dump("Model edit:", $id);
       // verifirer si on est connectée en tant qu'administrateur 
       $this->isAdmin();

        // créer un nouveau instance de tag est retourver pour un id
        $medias = (new Media($this->getDB()))->findById($id);
        
        //var_dump("Model edit:", $post);
        //var_dump("Model edit:", $tags);
        // retourner le vue des tags sur 'admin.tags.form'
        return $this->view('admin.medias.form', compact('medias'));
    }

    /**
     * Summary of UdpateMedia
     * @param int $id
     * @return void
     */
    public function update(int $id)
    {
        // verifirer si on est connectée en tant qu'administrateur
        $this->isAdmin();

        // créer un nouveau instant de tag
        $medias = new Media($this->getDB());

        // var_dump("PostController update:",$_POST);
       // var_dump("PostController update:",$_POST, $tags);

        // mondifier le media est attribée à la variable $result
        $result = $medias->update($id, $_POST);

        // si le media est modifier retourner le résultat sur 'admin/media'
        if ($result) {
            return header('Location: '.HREF_ROOT.'admin/medias');
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
        $medias = new Media($this->getDB());
        $result = $medias->destroy($id);

        // si c'est supprimé retourne le résultat sur la page 'admin/post'
        if ($result) {
            return header('Location: '.HREF_ROOT.'admin/medias');
        }
    }

   public function upload()
    {
       // var_dump("MediaController upload: ", $_FILES);
      

        foreach($_FILES['image_uploads']['name'] as $filename){
            /* Choose where to save the uploaded file */
            $location = DIR_IMAGES.$filename;
        }

        /* Save the uploaded files to the local filesystem */
          /* Get the name of the uploaded file */
        foreach ($_FILES['image_uploads']['tmp_name'] as $tmp_name) {
            if (move_uploaded_file($tmp_name, $location)) {
                echo 'Success upload image';                             
            } else {
                echo 'Failure upload image';
            }
        }

        return header('Location: '.HREF_ROOT.'admin/posts');    
    }
}