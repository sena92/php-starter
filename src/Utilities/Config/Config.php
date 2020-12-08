<?php

namespace App\Utilities\Config;

class Config
{
    /**
     * @param $file
     * @return mixed
     * @throws \Exception
     */
    public static function get($file)
    {
        $filePath = "./config/{$file}.php";

        if (!file_exists($filePath)) {
            throw new \Exception("Config file: {$file} doesn't exists");
        }

        return require $filePath;
    }
}