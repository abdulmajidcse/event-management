<?php

namespace App\Queries;

use App\Handlers\DatabaseHandler;
use PDO;

class UserQuery extends DatabaseHandler
{
    /**
     * get  all user from users table
     */
    public function getAllUser()
    {
        $query = $this->db()->prepare("SELECT * FROM users ORDER BY id DESC");
        $query->execute();

        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
}
