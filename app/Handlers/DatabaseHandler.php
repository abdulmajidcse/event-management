<?php

namespace App\Handlers;

use App\Interfaces\DatabaseHandlerInterface;
use PDO;

abstract class DatabaseHandler implements DatabaseHandlerInterface
{
    private ?PDO $pdo;

    public function __construct()
    {
        // init database connection
        $dbConfig = config('database') ?? [];
        $dsn = sprintf('%s:host=%s;dbname=%s', $dbConfig['driver'], $dbConfig['host'], $dbConfig['database']);

        $this->pdo = new PDO($dsn, $dbConfig['username'], $dbConfig['password']);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    /**
     * Get DB instance
     */
    public function db(): PDO
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
