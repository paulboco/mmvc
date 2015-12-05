<?php

namespace App\Models;

use Exception;

class Greeter
{
    /**
     * The model's attributes.
     *
     * @var array
     */
    protected $attributes;

    /**
     * Find a random greeter.
     *
     * @return array
     */
    public function findRandom()
    {
        $this->loadAttributes();

        return (array) $this->getById(rand(1, 3));
    }

    /**
     * Get a model by id.
     *
     * @param  integer  $id
     * @return stdClass
     */
    public function getById($id)
    {
        if (empty($this->attributes)) {
            throw new Exception("Class variable '\$attributes' is empty");
        }

        if (!isset($this->attributes[$id])) {
            throw new Exception("A model with id '{$id}' could not be found");
        }

        return $this->attributes[$id];
    }

    /**
     * Load model attributes from dummy JSON file.
     *
     * @return array
     */
    private function loadAttributes()
    {
        $this->attributes = json_decode(file_get_contents(
            'http://'. $_SERVER['HTTP_HOST'] . '/js/greeter.json'
        ));
    }
}
