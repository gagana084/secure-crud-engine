
<?php

// include __DIR__ . '/../config/Env.php';
require_once __DIR__ . '/../config/Env.php';


class Database
{
    private static $connection;

    public static function getConnection()
    {
        Database::setupConnection();
        return Database::$connection;
    }

    public static function setupConnection()
    {
        if (!isset(Database::$connection)) {
            $dbHost = Env::get('DB_HOST');
            $dbUser = Env::get('DB_USER');
            $dbPass = Env::get('DB_PASSWORD');
            $dbName = Env::get('DB_NAME');
            $dbPort = Env::get('DB_PORT');

            Database::$connection = new mysqli($dbHost, $dbUser, $dbPass, $dbName, $dbPort);

            if (Database::$connection->connect_error) {
                die("Connection failed: " . Database::$connection->connect_error);
            }
        }
    }



    public static function search($query, $params = [], $types = "")
    {
        Database::setupConnection();
        $stmt = Database::$connection->prepare($query);

        if ($stmt === false) {
            throw new Exception("Prepare failed: " . Database::$connection->error);
        }

        if ($params && $types) {
            $stmt->bind_param($types, ...$params);
        }

        $stmt->execute();
        return $stmt->get_result();
    }

    public static function iud($query, $params = [], $types = "")
    {
        Database::setupConnection();
        $stmt = Database::$connection->prepare($query);

        if ($stmt === false) {
            throw new Exception("Prepare failed: " . Database::$connection->error);
        }

        if ($params && $types) {
            $stmt->bind_param($types, ...$params);
        }

        return $stmt->execute();
    }
}

  
