<?php

namespace App\Service\User;

use App\Exception\AlreadyExistsException;
use App\Exception\DatabaseException;
use App\Model\UserModel;

class CreateService
{
    private UserModel $userModel;

    public function __construct(UserModel $userModel)
    {
        $this->userModel = $userModel;
    }

    /**
     * @throws AlreadyExistsException
     * @throws DatabaseException
     */
    public function create(array $data): int
    {
        $fields = ['name', 'email'];
        if (array_diff_key(array_flip($fields), $data)) {
            return 0;
        }

        if ($this->userModel->emailExists($data['email']) === true) {
            throw new AlreadyExistsException('Email already exists', 0);
        }

        return $this->userModel->create($data);
    }
}