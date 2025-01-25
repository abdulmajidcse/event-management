<?php

namespace App\Queries;

use App\Handlers\DatabaseHandler;
use PDO;

class UserQuery extends DatabaseHandler
{

    /**
     * Password bcrypt
     */
    private function bcrypt(string $password)
    {
        $hashOptions = [
            'cost' => 12,
        ];

        return password_hash($password, PASSWORD_BCRYPT, $hashOptions);
    }

    /**
     * Create a new account
     * 
     * @param array $data
     * 
     * @return bool
     */
    public function createUser(array $data): bool
    {
        $data['password'] = $this->bcrypt($data['password']);

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
     * Update user password
     * 
     * @param array $data
     * 
     * @return bool
     */
    public function updatePassword(array $data): bool
    {
        $password = $this->bcrypt($data['password']);

        $query = $this->db()->prepare("UPDATE `users` SET `password` = ? WHERE `id` = ?");

        return $query->execute([$password, $data['id']]);
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
