<?php

namespace App\Handlers;

use App\Interfaces\RouteHandlerInterface;

class RouteHandler implements RouteHandlerInterface
{

    private static $instance;

    // all routes
    private array $routes = [];
    // current uri and requset method
    private string $uri, $method;

    private function __construct()
    {
        // get the uri and request method
        $this->uri = currentUri();
        $this->method = $_SERVER['REQUEST_METHOD'];

        // Update url history
        $this->updateUrlHistory();
    }

    /**
     * Update url history
     */
    private function updateUrlHistory()
    {
        if (empty($_SESSION['current_uri'])) {
            // set old uri
            $_SESSION['old_uri'] = $this->uri;
        } else {
            // update old uri
            $_SESSION['old_uri'] = $_SESSION['current_uri'];
        }

        // set current uri
        $_SESSION['current_uri'] = $this->uri;
    }

    /**
     * get instance
     */
    public static function load(): self
    {
        if (!static::$instance) {
            static::$instance = new self();
        }

        return static::$instance;
    }

    /**
     * get route
     * @param string $uri
     * @param array $action
     * 
     * @return void
     */
    public function get(string $uri, array|callable $action): void
    {
        $this->routes[] = [
            'method' => 'GET',
            'uri' => $uri,
            'action' => $action
        ];
    }

    /**
     * post route
     * @param string $uri
     * @param array $action
     * 
     * @return void
     */
    public function post(string $uri, array|callable $action): void
    {
        $this->routes[] = [
            'method' => 'POST',
            'uri' => $uri,
            'action' => $action
        ];
    }

    /**
     * match the route
     * @param array $route
     * 
     * @return bool
     */
    private function matchRoute(array $route): bool
    {
        return $route['uri'] === $this->uri && $route['method'] === $this->method;
    }

    /**
     * run the application
     */
    public function run(): mixed
    {
        $targetRoute = null;
        foreach ($this->routes as $route) {
            // try to match route
            if ($this->matchRoute($route)) {
                $targetRoute = $route;
            }
        }

        if ($targetRoute) {
            // get the action
            $action = $targetRoute['action'];

            // when action is a function
            if (is_callable($action)) {
                return $action();
            }

            [$controller, $method] = $action;
            // create instance of the controller
            $controllerInstance = new $controller();
            // call the method of the controller
            // and return the result
            return $controllerInstance->$method();
        } else {
            // return 404 page if the route not found
            return notFoundView();
        }
    }
}
