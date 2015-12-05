<?php

namespace Support;

use Exception;

abstract class Model
{
    /**
     * The model's attributes.
     *
     * @var array
     */
    protected $attributes;

    /**
     * The path to the dummy data file.
     *
     * @var string
     */
    private $dataPath = '/js/Greeter.json';

    /**
     * Create a new model instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->attributes = $this->loadAttributes();
    }

    /**
     * Get an instance of the parent class.
     *
     * @return mixed
     */
    public static function instance()
    {
        return new static;
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
        return json_decode(file_get_contents(
            'http://'. $_SERVER['HTTP_HOST'] . $this->dataPath
        ));
    }

    /**
     * Get the called class's name.
     *
     * @return string
     */
    private function getCalledClass()
    {
        $class = get_called_class();

        return substr($class, (strrpos($class, '\\') + 1));
    }
}
