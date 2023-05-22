<?php

namespace App\Database;

use App\Exception\DatabaseException;

interface DatabaseInterface
{
    /**
     * @param string $sql
     * @param array $args
     * @return int
     * @throws DatabaseException
     */
    public function execute(string $sql, array $args = []): int;

    /**
     * @param string $sql
     * @param array $args
     * @return array
     * @throws DatabaseException
     */
    public function getAll(string $sql, array $args = []): array;

    /**
     * @param string $sql
     * @param array $args
     * @return mixed
     * @throws DatabaseException
     */
    public function getSingle(string $sql, array $args = []): mixed;

    /**
     * @return int
     */
    public function lastInsertId(): int;

    /**
     * @return bool
     * @throws DatabaseException
     */
    public function beginTransaction(): bool;

    /**
     * @return bool
     * @throws DatabaseException
     */
    public function commit(): bool;

    /**
     * @return bool
     * @throws DatabaseException
     */
    public function rollBack(): bool;
}