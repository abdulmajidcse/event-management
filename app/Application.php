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
        // start session
        $this->initSession();
        // load routes
        $this->registerRoutes();
    }

    /**
     * Init application session
     */
    private function initSession()
    {
        session_start();
        session_regenerate_id();
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
