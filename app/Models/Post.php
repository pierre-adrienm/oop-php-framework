<?php

namespace App\Models;

use DateTime;
use App\Models\Tag;
use App\Models\Media;

class Post extends Model {

    protected $table = 'posts';

    /**
     * Summary of getCreatedAt
     * @return string
     */
    public function getCreatedAt(): string
    {
        return (new DateTime($this->created_at))->format('d/m/Y à H:i');
    }

    /**
     * Summary of getExcerpt
     * @return string
     */
    public function getExcerpt(): string
    {
        return substr($this->content, 0, 200) . '...';
    }

    /**
     * Summary of getButton
     * @return string
     */
    public function getButton(): string
    {
        return '<a href="'.HREF_ROOT.'posts/'.$this->id.'" class="btn btn-primary">Lire l article</a>';
        // return <<<HTML
        // <a href="http://localhost/oop-php-framework/posts/$this->id" class="btn btn-primary">Lire l'article</a>
        // HTML;
    }

    /**
     * Summary of getTags
     * 
     * A Remplacer par  Models/Tag.php
     * @return mixed
     */
    public function getTags()
    {
        //  $tag = new Tag($this->db);

        // return $tag->getPosts();
        return $this->query("
            SELECT t.* FROM tags t
            INNER JOIN post_tag pt ON pt.tag_id = t.id
            WHERE pt.post_id = ?
        ", [$this->id]);
    }

    /**
     * Summary of getMedia
     * 
     * A Remplacer par  Models/Media.php
     * @return mixed
     */
    public function getMedias()
    {
        //  $media = new Media($this->db);

        // return $tag->getPosts();
        return $this->query("
            SELECT m.* FROM medias m
            INNER JOIN post_media pm ON pm.media_id = m.id
            WHERE pm.post_id = ?
        ", [$this->id]);
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

        // pour chaque relation  ajouter un lien avec le tag
        foreach ($relations['tags'] as $tagId) {
            $stmtTags = $this->db->getPDO()->prepare("INSERT post_tag (post_id, tag_id) VALUES (?, ?)");
            $stmtTags->execute([$id, $tagId]);
        }

        // pour chaque relation  ajouter un lien avec le media
        foreach ($relations['medias'] as $mediaId) {
            $stmtMedia = $this->db->getPDO()->prepare("INSERT post_media (post_id, media_id) VALUES (?, ?)");
            $stmtMedia->execute([$id, $mediaId]);
        }

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
        // selectionne le post à modifier
        parent::update($id, $data);

        // $stmt = $this->db->getPDO()->prepare("DELETE FROM post_tag WHERE post_id = ?");
        // $result = $stmt->execute([$id]);
        $stmtTags = $this->db->getPDO()->prepare("DELETE FROM post_tag WHERE post_id = ?");
        $resultTags = $stmtTags->execute([$id]);

        // pour chaque relation  à modifier un lien avec le tag
        foreach ($relations['tags'] as $tagId) {
            // $stmt = $this->db->getPDO()->prepare("INSERT post_tag (post_id, tag_id) VALUES (?, ?)");
            // $stmt->execute([$id, $tagId]);
            $stmtTags = $this->db->getPDO()->prepare("INSERT post_tag (post_id, tag_id) VALUES (?, ?)");
            $stmtTags->execute([$id, $tagId]);
        }

        $stmtMedia = $this->db->getPDO()->prepare("DELETE FROM post_media WHERE post_id = ?");
        $resultMedia = $stmtMedia->execute([$id]);

        // pour chaque relation  à modifier un lien avec le media
        foreach ($relations['medias'] as $mediaId) {
            $stmtMedia = $this->db->getPDO()->prepare("INSERT post_media (post_id, media_id) VALUES (?, ?)");
            $stmtMedia->execute([$id, $mediaId]);
        }
        
        // si c'est executé envoyer que c'est fait
        // if ($result) {
        //     return true;
        // }
        if ($resultTags && $resultMedia) {
            return true;
        }

    }
}
