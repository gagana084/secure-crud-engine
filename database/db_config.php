<?php
require_once __DIR__ . '/../config/Env.php';


class DatabaseConfig
{
    private static $host;
    private static $user;
    private static $password;
    private static $database;
    private static $port;

    public static function init()
    {
        self::$host = Env::get('DB_HOST') ?: 'localhost';
        self::$user = Env::get('DB_USER') ?: 'root';
        self::$password = Env::get('DB_PASSWORD') ?: '';
        self::$database = Env::get('DB_NAME') ?: '';
        self::$port = Env::get('DB_PORT') ?: 3306;
    }

    public static function get()
    {
        if (!self::$host) {
            self::init();
        }

        return [
            'host'     => self::$host,
            'user'     => self::$user,
            'password' => self::$password,
            'database' => self::$database,
            'port'     => self::$port,
        ];
    }
}

DatabaseConfig::init();

return DatabaseConfig::get();
