<?php

namespace Support;

class Controller
{
    /**
     * The view instance.
     *
     * @var View
     */
    protected $view;

    /**
     * The response instance.
     *
     * @var View
     */
    protected $response;

    function __construct(View $view, Response $response)
    {
        $this->view = $view;
        $this->response = $response;
    }
}
