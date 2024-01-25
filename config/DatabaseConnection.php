<?php

namespace config;

require_once 'config/config.php';

use Exception;
use PDO;
use PDOException;

class DatabaseConnection
{
    private static $instance;
    private $connection;

    /**
     * @throws Exception
     */
    private function __construct()
    {
        $driver = DB_DRIVER;
        $host = DB_HOST;
        $username = DB_USER;
        $password = DB_PASS;
        $database = DB_DATABASE;

        // Create a secure connection using PDO
        $dsn = "$driver:host=$host;dbname=$database;charset=utf8mb4";
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_EMULATE_PREPARES => false,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ];

        try {
            $this->connection = new PDO($dsn, $username, $password, $options);
        } catch (PDOException $e) {
            throw new Exception("Failed to connect to the database: " . $e->getMessage());
        }
    }

    public static function getInstance(): DatabaseConnection
    {
        if (!self::$instance) {
            self::$instance = new DatabaseConnection();
        }

        return self::$instance;
    }

    public function getConnection(): PDO
    {
        return $this->connection;
    }
}