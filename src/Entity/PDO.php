<?php

Namespace App\Entity;

class PDO extends \PDO 
{
    protected static $instance = null;

    protected function __construct() {
        //var_export(func_get_args());
        //die();
        parent::__construct(...func_get_args());
    }
    protected function __clone() {}

    public static function instance()
    {
        if (self::$instance === null)
        {
            config();
            $opt  = array(
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES   => FALSE,
                PDO::MYSQL_ATTR_FOUND_ROWS   => TRUE, //Added to activate PDO rowCount() in some of my queries
            );
            $dsn = 'mysql:host='.DB_HOST.';dbname='.DB_NAME.';charset='.DB_CHAR;
            self::$instance = new self($dsn, DB_USER, DB_PASS, $opt);
        }
        return self::$instance;
    }

    public static function __callStatic($method, $args)
    {
        return call_user_func_array(array(self::instance(), $method), $args);
    }

    public static function run($sql, $args = [])
    {
        if (!$args)
        {
             return self::instance()->query($sql);
        }
        $stmt = self::instance()->prepare($sql);
        $stmt->execute($args);
        return $stmt;
    }
}