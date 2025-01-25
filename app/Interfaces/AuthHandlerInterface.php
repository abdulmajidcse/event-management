<?php

namespace App\Interfaces;

interface AuthHandlerInterface
{
    /**
     * Class instance
     * 
     * @return self
     */
    public static function configure(): self;

    /**
     * Store auth user data to session
     * 
     * @param mixed $user
     */
    public function attempt(mixed $user);

    /**
     * Auth middleware
     * 
     * @param string $name
     */
    public function middleware(string $name);

    /**
     * Auth user
     * 
     * @return object|null
     */
    public function user(): object|null;

    /**
     * Check user authentication
     * 
     * @return bool
     */
    public function check(): bool;
}
