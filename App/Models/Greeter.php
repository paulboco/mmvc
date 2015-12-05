<?php

namespace App\Models;

use Support\Model;

class Greeter extends Model
{
    /**
     * Find a random greeter.
     *
     * @return stdClass
     */
    public function findRandom()
    {
        return $this->getById(rand(1, 3));
    }
}
