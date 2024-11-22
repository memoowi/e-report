<?php

require_once '../config/database.php';

class User {
    private $pdo;

    public function __construct() {
        $this->pdo = Database::getConnection(); 
    }

    /**
     * Check if email exists in the database.
     *
     * @param string $email
     * @return bool
     */
    public function emailExists($email) {
        $stmt = $this->pdo->prepare("SELECT id FROM users WHERE email = :email");
        $stmt->execute(['email' => $email]);
        return $stmt->fetch() !== false;
    }

    /**
     * Create a new user in the database.
     *
     * @param string $name
     * @param string $email
     * @param string $password
     * @return bool
     */
    public function createUser($name, $email, $password) {
        $stmt = $this->pdo->prepare("INSERT INTO users (name, email, password) VALUES (:name, :email, :password)");
        return $stmt->execute([
            'name' => $name,
            'email' => $email,
            'password' => password_hash($password, PASSWORD_DEFAULT),
        ]);
    }

    /**
     * Get user by email.
     *
     * @param string $email
     * @return array|false
     */
    public function getUserByEmail($email) {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->execute(['email' => $email]);
        return $stmt->fetch();
    }
}
