<?php

/**
 * @param $file
 * @return mixed
 * @throws Exception
 */
function config($file) {
    return \App\Utilities\Config\Config::get($file);
}

/**
 * @param $file
 * @param $vars
 * @return string
 * @throws Exception
 */
function view($file, $vars = []) {
    return \App\Utilities\View\View::render($file, $vars);
}

/**
 * @param $code
 */
function abort($code) {
    http_response_code($code);
    exit();
}

/**
 * @param $var
 */
function dd($var) {
    echo '<pre>';
    var_dump($var);
    echo '</pre>';
    exit();
}