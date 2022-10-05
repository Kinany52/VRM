<?php

Namespace App\Library;

use PDOStatement;
use PDOException;

/** @package App\Library */
class PDO extends \PDO 
{
    /** @var \App\Library\PDO $instance */
    protected static $instance = null;

    protected function __construct() {
        parent::__construct(...func_get_args());
    }
    /** @return void  */
    protected function __clone(): void 
    {}

    /** @return PDO  */
    public static function instance(): PDO
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

    /**
     * @param mixed $method 
     * @param array<mixed> $args 
     * @return mixed 
     */
    public static function __callStatic(mixed $method, array $args): mixed
    {
        return call_user_func_array(array(self::instance(), $method), $args);
    }

    /**
     * @param mixed $sql 
     * @param array<mixed> $args 
     * @return PDOStatement|false 
     * @throws PDOException 
     */
    public static function run(mixed $sql, array $args = []): PDOStatement|false
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