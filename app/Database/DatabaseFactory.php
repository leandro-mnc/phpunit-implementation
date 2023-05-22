<?php

namespace App\Database;

class DatabaseFactory
{
    /**
     * @var DatabaseInterface[]
     */
    private static array $instance = [];

    /**
     * @param string $db
     * @param string $username
     * @param string $password
     * @param string $host
     * @param int $port
     * @param array $options
     * @return DatabaseInterface
     * @throws \App\Exception\DatabaseException
     */
    public static function get(string $db, string $username, string $password, string $host = '127.0.0.1', int $port = 3306, array $options = []): DatabaseInterface
    {
        if (array_key_exists($db, self::$instance) === false) {
            self::$instance[$db] = new MysqlDriver($db, $username, $password, $host, $port, $options);
        }

        return self::$instance[$db];
    }

    /**
     * @return DatabaseInterface
     * @throws \App\Exception\DatabaseException
     */
    public static function getByEnv(): DatabaseInterface
    {
        $db = $_ENV['DB_NAME'];
        $username = $_ENV['DB_USER'];
        $password = $_ENV['DB_PASSWORD'];
        $host = $_ENV['DB_HOST'];
        $port = $_ENV['DB_PORT'];
        $options = [
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
            \PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4"
        ];

        return self::get($db, $username, $password, $host, $port, $options);
    }
}