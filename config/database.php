<?php

class Database {
    private static $host = 'localhost';  // Database host (usually localhost)
    private static $dbName = 'e-report'; // Your database name
    private static $username = 'root';  // Your database username (for XAMPP, it's typically 'root')
    private static $password = '';  // Your database password (for XAMPP, it's typically empty)

    private static $pdo;

    // Method to get the PDO connection
    public static function getConnection() {
        if (self::$pdo == null) {
            try {
                $dsn = 'mysql:host=' . self::$host . ';dbname=' . self::$dbName . ';charset=utf8';
                self::$pdo = new PDO($dsn, self::$username, self::$password);
                self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  // Error mode for debugging
            } catch (PDOException $e) {
                die('Connection failed: ' . $e->getMessage());
            }
        }

        return self::$pdo;
    }
}
