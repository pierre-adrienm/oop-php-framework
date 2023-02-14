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
        // créer un post
        parent::create($data);

        // attribuer un id puis le mettre sur le deriner de la liste
        $id = $this->db->getPDO()->lastInsertId();

        // pour chaque relation  ajouter un lien avec le media
        foreach ($relations as $mediaId) {
            $stmt = $this->db->getPDO()->prepare("INSERT post_media (post_id, med_id) VALUES (?, ?)");
            $stmt->execute([$id, $mediaId]);
        }

        // renvoie que c'est fait
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