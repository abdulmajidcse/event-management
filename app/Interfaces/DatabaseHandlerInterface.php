<?php

namespace App\Interfaces;

use PDO;

interface DatabaseHandlerInterface
{
    // database connection with PDO
    public function db(): PDO;
}
