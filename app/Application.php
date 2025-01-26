<?php

namespace App;

use App\Handlers\RouteHandler;
use App\Interfaces\ApplicationInterface;

class Application implements ApplicationInterface
{
    /**
     * Application instance
     * 
     * @var self
     */
    private static $instance;

    /**
     * Init the application setup
     */
    private function __construct()
    {
        // Start session
        $this->initSession();

        // Load routes
        $this->registerRoutes();
    }

    /**
     * Init application session
     */
    private function initSession()
    {
        session_start();
        session_regenerate_id(true);

        // Generate CSRF token
        $this->generateCsrfToken();
    }

    /**
     * Generate CSRF token if not already set
     */
    private function generateCsrfToken()
    {
        if (empty($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(40));
        }
    }

    /**
     * Load routes
     */
    private function registerRoutes()
    {
        // load the application routes
        require_once __DIR__ . '/../routes/web.php';
        require_once __DIR__ . '/../routes/api.php';
    }

    /**
     * Application instance
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
     * Create a new application
     *
     * @return void
     */
    public function create(): void
    {
        RouteHandler::load()->run();
        // remove flash data from session
        $this->removeSessionFlashData();
    }

    /**
     * Remove session flash data
     */
    private function removeSessionFlashData()
    {
        unset($_SESSION['invalid_request_data'], $_SESSION['status_message']);
    }
}
