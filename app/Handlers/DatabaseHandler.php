<?php

namespace App\Handlers;

use PDO;

abstract class DatabaseHandler
{
    private ?PDO $pdo;

    public function __construct()
    {
        // init database connection
        $dbConfig = config('database') ?? [];
        $dsn = sprintf('mysql:host=%s;dbname=%s', $dbConfig['host'], $dbConfig['database']);
        $this->pdo = new PDO($dsn, $dbConfig['username'], $dbConfig['password']);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    /**
     * Get DB instance
     */
    public function db()
    {
        return $this->pdo;
    }

    /**
     * Close DB connection
     */
    public function __destruct()
    {
        $this->pdo = null;
    }
}
