<?php

namespace App\Database;

use App\Exception\DatabaseException;

class MysqlDriver implements DatabaseInterface
{
    private \PDO $pdo;

    /**
     * @param string $db
     * @param string $username
     * @param string $password
     * @param string $host
     * @param int $port
     * @param array $options
     * @throws DatabaseException
     */
    public function __construct(string $db, string $username, string $password, string $host = '127.0.0.1', int $port = 3306, array $options = [])
    {
        $default_options = [
            \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
            \PDO::ATTR_EMULATE_PREPARES => false,
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
        ];
        $options = array_replace($default_options, $options);
        $dsn = "mysql:host=$host;dbname=$db;port=$port;charset=utf8mb4";

        try {
            $this->pdo = new \PDO($dsn, $username, $password, $options);
        } catch (\PDOException $e) {
            throw new DatabaseException($e->getMessage(), (int)$e->getCode());
        }
    }

    /**
     * @inheritDoc
     */
    public function execute(string $sql, array $args = []): int
    {
        if (count($args) < 1)
        {
            return $this->pdo->query($sql)->rowCount();
        }
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($args);
        return $stmt->rowCount();
    }

    /**
     * @inheritDoc
     */
    public function getAll(string $sql, array $args = []): array
    {
        if (count($args) < 1)
        {
            $result = $this->pdo->query($sql)->fetchAll();
            return $result !== false ? $result : [];
        }
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($args);
        $result = $stmt->fetchAll();
        return $result !== false ? $result : [];
    }

    /**
     * @inheritDoc
     */
    public function getSingle(string $sql, array $args = []): mixed
    {
        if (count($args) < 1)
        {
            return $this->pdo->query($sql)->fetch();
        }
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($args);
        return $stmt->fetch();
    }

    /**
     * @inheritDoc
     */
    public function lastInsertId(): int
    {
        return $this->pdo->lastInsertId();
    }

    /**
     * @inheritDoc
     */
    public function beginTransaction(): bool
    {
        return $this->pdo->beginTransaction();
    }

    /**
     * @inheritDoc
     */
    public function commit(): bool
    {
        return $this->pdo->commit();
    }

    /**
     * @inheritDoc
     */
    public function rollBack(): bool
    {
        return $this->pdo->rollBack();
    }
}