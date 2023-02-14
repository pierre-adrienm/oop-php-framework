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

        $posts = (new Media($this->getDB()))->all();

        return $this->view('admin.media.index', compact('media'));
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