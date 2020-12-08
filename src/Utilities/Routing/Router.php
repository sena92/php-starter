<?php

namespace App\Utilities\Routing;

use App\Utilities\Traits\SingletonTrait;

class Router
{
    use SingletonTrait;

    /**
     * @var array
     */
    protected $routes = [];

    /**
     * @var string string
     */
    protected $controllerPath = "App\\Controllers\\";

    /**
     * @param $method
     * @param $url
     * @param $controllerAction
     */
    public function add($method, $url, $controllerAction)
    {
        $method = strtoupper($method);

        list($controller, $action) = explode('@', $controllerAction);

        $url = rtrim($url, '/');

        $controller = $this->controllerPath . $controller;

        $this->routes[$method][$url] = [
            'controller' => $controller,
            'action' => $action
        ];
    }

    /**
     * @param $url
     * @param $controllerAction
     */
    public function get($url, $controllerAction)
    {
        $this->add('GET', $url, $controllerAction);
    }

    /**
     * @param $url
     * @param $controllerAction
     */
    public function post($url, $controllerAction)
    {
        $this->add('POST', $url, $controllerAction);
    }

    /**
     * @param $method
     * @param $url
     * @return mixed
     */
    public function run($method, $url)
    {
        $route = $this->getRoute($method, $url);

        if (empty($route)) {
            abort(404);
        }

        $controller = new $route['controller'];
        $action = $route['action'];

        $args = $route['args'] ?? [];

        return $controller->{$action}(...$args);
    }

    /**
     * @param $method
     * @param $url
     * @return array|mixed
     */
    protected function getRoute($method, $url)
    {
        $url = rtrim($url, '/');

        $route = $this->routes[$method][$url] ?? [];

        if (empty($route)) {
            $route = $this->checkDynamicRoute($method, $url);
        }

        return $route;
    }

    /**
     * @param $method
     * @param $url
     * @return array|mixed
     */
    protected function checkDynamicRoute($method, $url)
    {
        $url = explode('/', $url);

        foreach ($this->routes[$method] as $route => $action) {
            $route = explode('/', $route);
            $placeholders = preg_grep("/{.*?}/", $route);
            $params = array_diff($url, $route);

            if (array_keys($placeholders) === array_keys($params)) {
                $action['args'] = $params;

                return $action;
            }
        }

        return [];
    }

    /**
     *
     */
    public function registerRoutes()
    {
        require './routes/web.php';
    }
}