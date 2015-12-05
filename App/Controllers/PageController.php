<?php

namespace App\Controllers;

use Support\Controller;
use Support\Response;
use App\Models\Greeter;

class PageController extends Controller
{
    /**
     * The welcome page.
     */
    public function welcome()
    {
        $greeter = Greeter::instance()->findRandom();

        return $this->view->make('page/welcome', array(
            'salutation' => $greeter->salutation,
            'greeting' => $greeter->greeting,
            'endearment' => $greeter->endearment,
        ));
    }

    /**
     * The home page.
     *
     * @param  string  $name
     * @return mixed
     */
    public function home($name = null)
    {
        if (empty($name)) {
            return $this->response->redirect('/page/nameless');
        }

        return $this->view->make('page/home', compact('name'));
    }

    /**
     * The nameless page.
     *
     * @return Support\View
     */
    public function nameless()
    {
        return $this->view->make('page/nameless');
    }
}
