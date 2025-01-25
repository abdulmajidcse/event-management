<?php

namespace App\Queries;

use App\Handlers\DatabaseHandler;
use PDO;

class UserQuery extends DatabaseHandler
{

    public function createUser(array $data)
    {
        $hashOptions = [
            'cost' => 12,
        ];

        $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT, $hashOptions);

        $query = $this->db()->prepare("INSERT INTO `users`(`name`, `email`, `password`) VALUES (?, ?, ?)");
        $query->execute([$data['name'], $data['email'], $data['password']]);
    }

    /**
     * get  all user from users table
     */
    public function getAllUser()
    {
        $query = $this->db()->prepare("SELECT * FROM users ORDER BY id DESC");
        $query->execute();

        return $query->fetchAll(PDO::FETCH_OBJ);
    }
}
