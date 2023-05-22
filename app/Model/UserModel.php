<?php

namespace App\Model;

use App\Database\DatabaseInterface;

class UserModel
{
    private DatabaseInterface $database;

    public function __construct(DatabaseInterface $database)
    {
        $this->database = $database;
    }

    /**
     * @param string $email
     * @return bool
     * @throws \App\Exception\DatabaseException
     */
    public function emailExists(string $email): bool
    {
        $query = "SELECT COUNT(*) AS total FROM user WHERE email = :email";
        $args[':email'] = $email;
        $row = $this->database->getSingle($query, $args);

        return $row['total'] > 0;
    }

    /**
     * @param array $data
     * @return bool
     * @throws \App\Exception\DatabaseException
     */
    public function update(array $data): bool
    {
        if (array_key_exists('id', $data) === false) {
            return false;
        }

        $fields = ['name', 'email'];
        $args[':id'] = $data['id'];
        $set = [];
        foreach ($data as $key => $row) {
            if (array_key_exists($key, $fields) === true) {
                $set[$key] = ':' . $key;
                $args[':' . $key] = $row;
            }
        }

        $query = "UPDATE user SET " . implode(',', $set) . " WHERE id = :id";

        return $this->database->execute($query, $args) > 0;
    }

    /**
     * @param array $data
     * @return int
     * @throws \App\Exception\DatabaseException
     */
    public function create(array $data): int
    {
        $fields = ['name', 'email'];
        $args = [];
        foreach ($fields as $field) {
            if (array_key_exists($field, $data) === true) {
                $args[':' . $field] = $data[$field];
            }
        }
        $query = "INSERT INTO user (name, email) VALUES(" . implode(',', array_keys($args)) . ")";

        $result = $this->database->execute($query, $args);

        if ($result < 1) {
            return 0;
        }
        return $this->database->lastInsertId();
    }
}