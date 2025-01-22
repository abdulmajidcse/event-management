<?php

namespace Abdulmajidcse\EventManagement;

class RequestHandler
{

    private array $routes = [];
    private string $uri, $method;

    public function __construct()
    {
        $this->uri = $_SERVER['PATH_INFO'] ?? '/';
        $this->method = $_SERVER['REQUEST_METHOD'];
    }

    public function get(string $uri, array $action)
    {
        $this->routes[] = [
            'method' => 'GET',
            'uri' => $uri,
            'action' => $action
        ];

        return $this;
    }

    public function post(string $uri, array $action)
    {
        $this->routes[] = [
            'method' => 'POST',
            'uri' => $uri,
            'action' => $action
        ];
    }

    private function matchRoute(array $route): bool
    {
        return $route['uri'] === $this->uri && $route['method'] === $this->method;
    }

    public function run()
    {
        $targetRoute = null;
        foreach ($this->routes as $route) {
            if ($this->matchRoute($route)) {
                $targetRoute = $route;
            }
        }

        if ($targetRoute) {
            $action = $targetRoute['action'];
            [$controller, $method] = $action;
            if (class_exists($controller) && method_exists($controller, $method)) {
                $controllerInstance = new $controller();
                return $controllerInstance->$method();
            } else {
                throw new \Exception('class or method not found where the uri is ' . $this->uri . ' and the class is ' . $controller . ' and the method is ' . $method);
            }
        } else {
            return view('404.php');
        }
    }
}
