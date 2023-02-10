<?php

namespace App\Models;

class Tag extends Model
{

    protected $table = 'tags';

    /**
     * Summary of getTags
     * @return mixed
     */
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
     * Summary of update
     * @param int $id
     * @param mixed $data
     * @param array|null $relations
     * @return bool
     */
    public function update(int $id, mixed $data, ?array $relations = null)
    {
        parent::update($id, $data);

        return true;

    }

    /**
     * Summary of getButton
     * @return string
     */
    public function getButton(): string
    {
        return '<a href="'.HREF_ROOT.'tags/'.$this->id.'" class="btn btn-primary">Lire l tag</a>';
        // return <<<HTML
        // <a href="http://localhost/oop-php-framework/posts/$this->id" class="btn btn-primary">Lire l'article</a>
        // HTML;
    }
}
