
<?php
require __DIR__ . '/../vendor/autoload.php';

use Dotenv\Dotenv;

class Env
{
    private static $loaded = false;

    public static function load()
    {
        if (!self::$loaded) {
            $dotenv = Dotenv::createImmutable(__DIR__ . '/../');
            $dotenv->load();
            self::$loaded = true;
        }
    }

    public static function get(string $key, $default = null)
    {
        self::load();
        return $_ENV[$key] ?? $default;
    }
}
