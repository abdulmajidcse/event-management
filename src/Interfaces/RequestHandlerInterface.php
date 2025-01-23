<?php

namespace Abdulmajidcse\EventManagement\Interfaces;

interface RequestHandlerInterface
{
    /**
     * get route
     * @param string $uri
     * @param array $action
     * 
     * @return RequestHandlerInterface
     */
    public function get(string $uri, array $action);

    /**
     * post route
     * @param string $uri
     * @param array $action
     * 
     * @return RequestHandlerInterface
     */
    public function post(string $uri, array $action);

    /**
     * run the application
     */
    public function run();
}
