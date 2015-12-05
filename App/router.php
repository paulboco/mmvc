<?php

/*
|--------------------------------------------------------------------------
| Router
|--------------------------------------------------------------------------
*/

// format URI
$uri = $_SERVER['REQUEST_URI'];
$uri = ltrim($uri, '/');

//explode URI into segments
$segments = explode('/', $uri);
$segments = array_map(function($v) {
    return urldecode($v);
}, $segments);

// shift first element off segments array and assign to controller name
$controllerName = ucfirst(strtolower(array_shift($segments)));
$controllerName = $controllerName ?: 'Page';
$controllerName = 'App\\Controllers\\' . $controllerName . 'Controller';

// shift first element off segments array and assign to method name
$methodName = array_shift($segments);
$methodName = $methodName ?: 'welcome';

// assign parameters from remaining segments
$parameters = $segments;

/*
|--------------------------------------------------------------------------
| Check that the controller file exists and require it.
|--------------------------------------------------------------------------
*/

if (!file_exists(__DIR__ . '/../' . str_replace('\\', '/', $controllerName) . '.php')) {
    header("HTTP/1.0 404 Not Found");
    require __DIR__ . '/../App/views/errors/404.php';
    die;
}

require __DIR__ . '/../' . str_replace('\\', '/', $controllerName) . '.php';

/*
|--------------------------------------------------------------------------
| Check that the method name exists on the controller class.
|--------------------------------------------------------------------------
*/

if (!method_exists($controllerName, $methodName)) {
    header("HTTP/1.0 404 Not Found");
    require __DIR__ . '/../App/views/errors/404.php';
    die;
}

/*
|--------------------------------------------------------------------------
| Call the controller method.
|--------------------------------------------------------------------------
*/

call_user_func_array(
    array(new $controllerName, $methodName),
    $parameters
);
