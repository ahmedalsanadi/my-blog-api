<?php

require_once './config.php';

class User
{

    public function findUserByUsername(string $username): ?array
    {

        $db = getDB();
        $stmt = $db->prepare("SELECT * FROM users WHERE username = :username");
        $stmt->execute(['username' => $username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        return $user ?: null;
    }

    public function verifyPassword(string $password, string $hash): bool
    {

        return password_verify($password, $hash);
    }

    public function createUser(string $username, string $password): void
    {

        $db = getDB();
        $stmt = $db->prepare("INSERT INTO users (username, password) VALUES (:username, :password)");
        $stmt->execute(['username' => $username, 'password' => $password]);

    }
}

