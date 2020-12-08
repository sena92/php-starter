<?php

namespace App\Utilities\View;

class View
{
    /**
     * @param $file
     * @param $vars
     * @throws \Exception
     * @return string
     */
    public static function render($file, $vars = [])
    {
        $path = "./resources/views/{$file}.php";

        if (!file_exists($path)) {
            throw new \Exception("View file: {$file} not found");
        }

        require $path;
    }
}