<?php

namespace App\Queries;

use App\Handlers\DatabaseHandler;
use PDO;

class UserQuery extends DatabaseHandler
{
    /**
     * Create a new account
     * 
     * @param array $data
     * 
     * @return bool
     */
    public function createUser(array $data): bool
    {
        $hashOptions = [
            'cost' => 12,
        ];

        $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT, $hashOptions);

        $query = $this->db()->prepare("INSERT INTO `users`(`name`, `email`, `password`) VALUES (?, ?, ?)");

        return $query->execute([$data['name'], $data['email'], $data['password']]);
    }

    /**
     * Update user data
     * 
     * @param array $data
     * 
     * @return bool
     */
    public function updateUser(array $data): bool
    {
        $query = $this->db()->prepare("UPDATE `users` SET `name` = ?, `email` = ? WHERE `id` = ?");

        return $query->execute([$data['name'], $data['email'], $data['id']]);
    }

    /**
     * Single user data by id
     * 
     * @param int $id
     * 
     * @return mixed
     */
    public function getUserById(int $id): mixed
    {
        // user find query
        $query = $this->db()->prepare("SELECT * FROM `users` WHERE `id` = ? LIMIT 1");
        $query->execute([$id]);

        // user data
        return $query->fetch(PDO::FETCH_OBJ);
    }

    /**
     * Single user data by email
     * 
     * @param string $email
     * 
     * @return mixed
     */
    public function getUserByEmail(string $email): mixed
    {
        // user find query
        $query = $this->db()->prepare("SELECT * FROM `users` WHERE `email` = ? LIMIT 1");
        $query->execute([$email]);

        // user data
        return $query->fetch(PDO::FETCH_OBJ);
    }

    /**
     * get  all user from users table
     * 
     * @return array
     */
    public function getAllUser(): array
    {
        $query = $this->db()->prepare("SELECT * FROM `users` ORDER BY `id` DESC");
        $query->execute();

        return $query->fetchAll(PDO::FETCH_OBJ);
    }
}
