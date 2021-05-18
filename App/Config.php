<?php
declare(strict_types=1);

namespace App;

final class Config
{
    private static $instance = null;
    public static $data;
    /**
     * gets the instance via lazy initialization (created on first usage)
     */
    public static function getInstance()
    {
        if (static::$instance === null) {

            static::$instance = new static();
        }

        return static::$instance;
    }

    /**
     * @return mixed
     */
    public function getData($key)
    {
        self::$data = (include __DIR__ . '/../config.php')['db'];
        return self::$data[$key];
    }

    /**
     * is not allowed to call from outside to prevent from creating multiple instances,
     * to use the singleton, you have to obtain the instance from Singleton::getInstance() instead
     */
    private function __construct()
    {
    }

    /**
     * prevent the instance from being cloned (which would create a second instance of it)
     */
    private function __clone()
    {
    }

    /**
     * prevent from being unserialized (which would create a second instance of it)
     */
    private function __wakeup()
    {
    }
}