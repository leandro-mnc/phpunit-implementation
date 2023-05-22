<?php

namespace App\Database;

use App\Exception\DatabaseException;

class Database implements DatabaseInterface
{
    private DatabaseInterface $database;

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
        $this->database = new MysqlDriver($db, $username, $password, $host, $port, $options);
    }

    /**
     * @inheritDoc
     */
    public function execute(string $sql, array $args = []): int
    {
        try {
            return $this->database->execute($sql, $args);
        } catch (\PDOException $e) {
            throw new DatabaseException($e->getMessage(), $e->getCode(), $e);
        }
    }

    /**
     * @inheritDoc
     */
    public function getAll(string $sql, array $args = []): array
    {
        try {
            return $this->database->getAll($sql, $args);
        } catch (\PDOException $e) {
            throw new DatabaseException($e->getMessage(), $e->getCode(), $e);
        }
    }

    /**
     * @inheritDoc
     */
    public function getSingle(string $sql, array $args = []): mixed
    {
        try {
            return $this->database->getSingle($sql, $args);
        } catch (\PDOException $e) {
            throw new DatabaseException($e->getMessage(), $e->getCode(), $e);
        }
    }

    /**
     * @inheritDoc
     */
    public function beginTransaction(): bool
    {
        try {
            return $this->database->beginTransaction();
        } catch (\PDOException $e) {
            throw new DatabaseException($e->getMessage(), $e->getCode(), $e);
        }
    }

    /**
     * @inheritDoc
     */
    public function commit(): bool
    {
        try {
            return $this->database->commit();
        } catch (\PDOException $e) {
            throw new DatabaseException($e->getMessage(), $e->getCode(), $e);
        }
    }

    /**
     * @inheritDoc
     */
    public function rollBack(): bool
    {
        try {
            return $this->database->rollBack();
        } catch (\PDOException $e) {
            throw new DatabaseException($e->getMessage(), $e->getCode(), $e);
        }
    }
}
