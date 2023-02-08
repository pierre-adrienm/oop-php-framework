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
     * @param mixed|null $relations
     * @return bool
     */
    public function create(array $data,  mixed $relations = null)
    {
        parent::create($data);

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
     * Summary of update
     * @param int $id
     * @param mixed $data
     * @param array|null $relations
     * @return bool
     */
    public function update(int $id, mixed $data, ?array $relations = null)
    {
        parent::update($id, $data);

        // $stmt = $this->db->getPDO()->prepare("DELETE FROM post_tag WHERE post_id = ?");
        // $result = $stmt->execute([$id]);

        // foreach ($relations as $tagId) {
        //     $stmt = $this->db->getPDO()->prepare("INSERT post_tag (post_id, tag_id) VALUES (?, ?)");
        //     $stmt->execute([$id, $tagId]);
        // }

        // if ($result) {
            return true;
        // }

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
