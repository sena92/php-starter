<?php

use App\Utilities\Routing\Router;

$router = Router::getInstance();

$router->get('/', 'HomeController@index');