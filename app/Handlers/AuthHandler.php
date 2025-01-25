<?php

namespace App\Handlers;

use App\Interfaces\AuthHandlerInterface;
use App\Queries\UserQuery;

class AuthHandler implements AuthHandlerInterface
{
    private static $instance;

    private function __construct()
    {
        $user = $this->user();

        if ($user) {
            $user = (new UserQuery)->getUserById($user->id);
        } else {
            $user = null;
        }

        $this->attempt($user);
    }

    /**
     * Class instance
     * 
     * @return self
     */
    public static function configure(): self
    {
        if (!static::$instance) {
            static::$instance = new self;
        }

        return static::$instance;
    }

    /**
     * Store auth user data to session
     * 
     * @param mixed $user
     */
    public function attempt(mixed $user)
    {
        if ($user) {
            $_SESSION['auth_user'] = $user;
        } else {
            unset($_SESSION['auth_user']);
        }
    }

    /**
     * Auth middleware
     * 
     * @param string $name
     */
    public function middleware(string $name)
    {
        if ($name == 'auth' && !$this->check()) {
            // redirect if user not authenticated
            redirect('/login');
            exit;
        } else if ($name == 'guest' && $this->check()) {
            // redirect if user authenticated
            redirect('/dashboard');
            exit;
        }
    }

    /**
     * Auth user
     * 
     * @return object|null
     */
    public function user(): object|null
    {
        if (!empty($_SESSION['auth_user'])) {
            return $_SESSION['auth_user'];
        }

        return null;
    }

    /**
     * Check user authentication
     * 
     * @return bool
     */
    public function check(): bool
    {
        return boolval($this->user());
    }
}
