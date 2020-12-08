<?php

namespace App\Controllers;

class HomeController
{
    /**
     * @return string
     * @throws \Exception
     */
    public function index()
    {
        return view('index');
    }
}