<?php

class Database {
    private static $host = 'localhost'; 
    private static $dbName = 'e-report';
    private static $username = 'root';
    private static $password = '';

    private static $pdo;

    public static function getConnection() {
        if (self::$pdo == null) {
            try {
                $dsn = 'mysql:host=' . self::$host . ';dbname=' . self::$dbName . ';charset=utf8';
                self::$pdo = new PDO($dsn, self::$username, self::$password);
                self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die('Connection failed: ' . $e->getMessage());
            }
        }

        return self::$pdo;
    }
}
