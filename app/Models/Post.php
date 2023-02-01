<?php

namespace App\Models;

use DateTime;
use App\Models\Tag;

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
     * Summary of create
     * @param array $data
     * @param array|null $relations
     * @return bool
     */
    public function create(array $data, ?array $relations = null)
    {
        parent::create($data);

        $id = $this->db->getPDO()->lastInsertId();

        foreach ($relations as $tagId) {
            $stmt = $this->db->getPDO()->prepare("INSERT post_tag (post_id, tag_id) VALUES (?, ?)");
            $stmt->execute([$id, $tagId]);
        }

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
        parent::update($id, $data);

        $stmt = $this->db->getPDO()->prepare("DELETE FROM post_tag WHERE post_id = ?");
        $result = $stmt->execute([$id]);

        foreach ($relations as $tagId) {
            $stmt = $this->db->getPDO()->prepare("INSERT post_tag (post_id, tag_id) VALUES (?, ?)");
            $stmt->execute([$id, $tagId]);
        }

        if ($result) {
            return true;
        }

    }
}
