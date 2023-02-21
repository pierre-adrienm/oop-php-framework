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

        $media = (new Media($this->getDB()))->all();

        return $this->view('admin.media.index', compact('media'));
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
        $media = (new Media($this->getDB()))->all();

        // retourne le résultat de l'affiche sur 'admin.tags.form'
        return $this->view('admin.media.form');
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
        $media = new Media($this->getDB());

        $tags = array_pop($_POST);

        $result = $media->create($_POST, $tags);

        if ($result) {
            return header('Location:'.HREF_ROOT.'admin/media');
        }
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
        $media = new Media($this->getDB());

        // var_dump("PostController update:",$_POST);
       // var_dump("PostController update:",$_POST, $tags);

        // mondifier le media est attribée à la variable $result
        $result = $media->update($id, $_POST);

        // si le media est modifier retourner le résultat sur 'admin/media'
        if ($result) {
            return header('Location: '.HREF_ROOT.'admin/media');
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
        $post = new Media($this->getDB());
        $result = $post->destroy($id);

        // si c'est supprimé retourne le résultat sur la page 'admin/post'
        if ($result) {
            return header('Location: '.HREF_ROOT.'admin/media');
        }
    }
}