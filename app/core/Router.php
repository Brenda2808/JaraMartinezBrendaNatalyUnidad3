<?php

class Router
{
    private $routes = [];

    public function get($route, $action)
    {
        $this->routes['GET'][$route] = $action;
    }
    public function post($route, $action)
    {
        $this->routes['POST'][$route] = $action;
    }
    public function dispatch()
    {
        $url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        $method = $_SERVER['REQUEST_METHOD'];

        if (isset($this->routes[$method][$url])) {

            $action = $this->routes[$method][$url];

            echo $action();

        } else {

            http_response_code(404);

            echo "404 - Página no encontrada";
        }
    }
}