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

    /**
     * Summary of createTags
     * @param string $name
     * @return mixed
     */
    public function createTags(string $name)
    {
        return $this->query("INSERT INTO tags VALUES ({$name})");
    }

    /**
     * Summary of updateTags
     * @param string $name
     * @return mixed
     */
    public function updateTags(string $name)
    {
        return $this->query("UPDATE TABLE tags SET non={$name} where id=?",[$this->id]);
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
