<?php

namespace App\Controllers;

use App\Models\Greeter;

class PageController
{
    /**
     * The welcome page.
     *
     * This page is requested by uri '/' or 'page/welcome'.
     * @return void
     */
    public function welcome()
    {
        require __DIR__ . '/../../App/Models/Greeter.php';
        $greeter = new Greeter;
        extract($greeter->findRandom());

        require __DIR__ . '/../views/page/welcome.php';
    }

    /**
     * The home page.
     *
     * This page is requested by uri 'page/home'.
     *
     * @param  string  $name
     * @return void
     */
    public function home($name = null)
    {
        if (is_null($name)) {
            header('Location: /page/nameless');
            die;
        }

        require __DIR__ . '/../views/page/home.php';
    }

    /**
     * The nameless page.
     *
     * This page is requested by uri 'page/nameless'.
     *
     * @return void
     */
    public function nameless()
    {
        require __DIR__ . '/../views/page/nameless.php';
    }
}
