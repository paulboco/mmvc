<?php

if (!function_exists('d')) {
    /**
     * Dump Variable
     *
     * @return void
     */
    function d() {
        array_map(function ($x) {
            echo '<pre>';
            var_dump($x);
            echo '</pre>';
        }, func_get_args());
    }
}

if (!function_exists('dd')) {
    /**
     * Dump Variable and Die
     *
     * @return void
     */
    function dd() {
        array_map(function ($x) {
            echo '<pre>';
            var_dump($x);
            echo '</pre>';
        }, func_get_args());
        die();
    }
}

if (!function_exists('e')) {
    /**
     * Echo an htmlentities filtered string.
     *
     * @param  string  $string
     * @return void
     */
    function e($string) {
        echo htmlentities($string);
    }
}
