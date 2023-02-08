<?php

namespace App\Models;

class Tag extends Model
{

    protected $table = 'tags';

    /**
     * Summary of getPosts
     * @return mixed
     */
    public function getPosts()
    {
        return $this->query("
            SELECT p.* FROM posts p
            INNER JOIN post_tag pt ON pt.post_id = p.id
            WHERE pt.tag_id = ?
        ", [$this->id]);
    }

    public function getTags()
    {
        return $this->query("SELECT * FROM tags",[$this->id]);
    }

    /**
     * Summary of create
     * @param array $data
     * @param array|null $relations
     * @return bool
     */
    public function create(array $data,  mixed $relations = null)
    {
        var_dump($data);
        parent::create($data);

        // $id = $this->db->getPDO()->lastInsertId();

        // $stmt = $this->db->getPDO()->prepare("INSERT tags VALUES (?)");
        // $stmt->execute();

        return true;
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
        return '<a href="'.HREF_ROOT.'tags/'.$this->id.'" class="btn btn-primary">Lire l article</a>';
        // return <<<HTML
        // <a href="http://localhost/oop-php-framework/posts/$this->id" class="btn btn-primary">Lire l'article</a>
        // HTML;
    }
}
