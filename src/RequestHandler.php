<?php

namespace Abdulmajidcse\EventManagement;

use Abdulmajidcse\EventManagement\Interfaces\RequestHandlerInterface;

class RequestHandler implements RequestHandlerInterface
{

    // all routes
    private array $routes = [];
    // current uri and requset method
    private string $uri, $method;

    public function __construct()
    {
        // get the uri and request method
        $this->uri = $_SERVER['PATH_INFO'] ?? '/';
        $this->method = $_SERVER['REQUEST_METHOD'];
    }

    /**
     * get route
     * @param string $uri
     * @param array $action
     * 
     * @return RequestHandlerInterface
     */
    public function get(string $uri, array $action)
    {
        $this->routes[] = [
            'method' => 'GET',
            'uri' => $uri,
            'action' => $action
        ];

        return $this;
    }

    /**
     * post route
     * @param string $uri
     * @param array $action
     * 
     * @return RequestHandlerInterface
     */
    public function post(string $uri, array $action)
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
    public function run()
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
            [$controller, $method] = $action;
            if (class_exists($controller) && method_exists($controller, $method)) {
                // create instance of the controller
                $controllerInstance = new $controller();
                // call the method of the controller
                // and return the result
                return $controllerInstance->$method();
            } else {
                // throw exception if the class or method not found
                throw new \Exception('class or method not found where the uri is ' . $this->uri . ' and the class is ' . $controller . ' and the method is ' . $method);
            }
        } else {
            // return 404 page if the route not found
            return view('404.php');
        }
    }
}
