<?php

namespace App\Models;

class Media extends Model
{

    protected $table= 'media';

    /**
     * Summary of getMedia
     * @return mixed
     */
    public function getMedia()
    {
        // retourne résultat de la séléction du tableau media
        return $this->query("SELECT * FROM media",[$this->id]);
    }

    /**
     * Summary of create
     * @param array $data
     * @param array|null $relations
     * @return bool
     */
    public function create(array $data, ?array $relations = null)
    {
        // créer un media
        parent::create($data);

        // renvoie que c'est fait
        return true;
    }

    /**
     * Summary of update
     * @param int $id
     * @param mixed $data
     * @param array|null $relations
     * @return bool
     */
    public function update(int $id, mixed $data, ?array $relations = null)
    {
        // modifie le media
        parent::update($id, $data);

        // un fois effectuer envoie le résultat que c'est fait
        return true;
    }

    /**
     * Summary of getButton
     * @return string
     */
    public function getButton(): string
    {
        return '<a href="'.HREF_ROOT.'media/'.$this->id.'" class="btn btn-primary">Lire l media</a>';
        // return <<<HTML
        // <a href="http://localhost/oop-php-framework/posts/$this->id" class="btn btn-primary">Lire l'article</a>
        // HTML;
    }
}