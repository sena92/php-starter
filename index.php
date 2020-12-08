<?php

require './vendor/autoload.php';

use App\Utilities\Routing\Router;

$router = Router::getInstance();
$router->registerRoutes();

$router->run(
    $_SERVER['REQUEST_METHOD'],
    $_SERVER['REQUEST_URI']
);