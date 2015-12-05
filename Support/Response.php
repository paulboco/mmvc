<?php

namespace Support;

use Exception;

class Response
{
    /**
     * Send the response to the browser.
     *
     * @param  mixed  $response
     * @return void
     */
    public function send($response)
    {
        if ($response === false) {
            die(View::instance()->make('errors/404'));
        }

        if (is_callable($response)) {
            call_user_func($response);
            die;
        }

        if (is_string($response)) {
            die($response);
        }

        throw new Exception('Cannot process response of type ' . gettype($response) . '.');

    }

    /**
     * Redirect to another location.
     *
     * @param  string  $uri
     * @return Closure
     */
    public static function redirect($uri)
    {
        return function() use ($uri){
            header("Location: {$uri}");
        };
    }
}
