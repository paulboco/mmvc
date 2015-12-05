<?php

namespace Support;

class Router
{
    /**
     * The controllers namespace path.
     *
     * @var string
     */
    private $controllersPath = 'App\\Controllers\\';

    /**
     * The controller name.
     *
     * @var string
     */
    private $controller = 'PageController';

    /**
     * The method name.
     *
     * @var string
     */
    private $method = 'welcome';

    /**
     * The request parameters.
     *
     * @var array
     */
    private $parameters = array();

    /**
     * Create a new router instance.
     *
     * @param  string  $controllersPath
     * @param  string  $defaultController
     * @param  string  $defaultMethod
     * @return void
     */
     public function __construct(
        $controllersPath = null,
        $defaultController = null,
        $defaultMethod = null
    )
    {
         $this->controllersPath = $controllersPath ?: $this->controllersPath;
         $this->controller = $this->controllersPath . ($defaultController ?: $this->controller);
         $this->method = $defaultMethod ?: $this->method;
    }

    /**
     * Dispatch the request.
     *
     * @return mixed
     */
    public function dispatch()
    {
        $this->parseUri();

        return $this->callControllerMethod();
    }

    /**
     * Parse the URI into controller, method and parameters properties.
     *
     * @return void
     */
    private function parseUri()
    {
        if ($_SERVER['REQUEST_URI'] == '/') {
            return;
        }

        $segments = $this->getSegments();

        $this->setController(array_shift($segments));
        $this->setMethod(array_shift($segments));
        $this->setParameters($segments);
    }

    /**
     * Set the controller property.
     *
     * @param  string  $controller
     * @return void
     */
     private function setController($controller)
     {
        $controllerName = ucfirst(strtolower($controller)) . 'Controller';

        $this->controller = $this->controllersPath . $controllerName;
     }

    /**
     * Set the method property.
     *
     * @param  string  $method
     * @return void
     */
     private function setMethod($method)
     {
        $this->method = strtolower($method);
     }

     /**
      * Set parameters property.
      *
      * @param  array  $parameters
      * @return void
      */
     private function setParameters($parameters)
     {
        $this->parameters = $parameters;
     }

    /**
     * Return an array of URI segments.
     */
    private function getSegments()
    {
        $segments = explode('/', $this->prepUri());

        return array_map(function($v) {
            return urldecode($v);
        }, $segments);
    }

    /**
     * Prepare the URI for use.
     *
     * @return string
     */
    private function prepUri()
    {
        $queryString = '?' . $_SERVER['QUERY_STRING'];

        return str_replace($queryString, '', trim($_SERVER['REQUEST_URI'], '/'));
    }

    /**
     * Call the controller method.
     *
     * @return boolean
     */
    private function callControllerMethod()
    {
        if (!method_exists($this->controller, $this->method)) {
            return false;
        }

        return call_user_func_array(
            array(new $this->controller(new View, new Response), $this->method),
            $this->parameters
        );
    }
}
