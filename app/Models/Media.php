<?php

namespace App\Models;

class Media extends Model
{

    protected $table= 'medias';

    /**
     * Summary of create
     * @param array $data
     * @param mixed|null $relations
     * @return bool
     */
    public function create(array $data, mixed $relations = null)
    {
        // créer un media
        // parent::create($data);

        // renvoie que c'est fait
        // return true;
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
        // parent::update($id, $data);

        // un fois effectuer envoie le résultat que c'est fait
        // return true;
    }

}