<?php
declare(strict_types=1);

namespace Tests\Unit\Model;

use App\Database\DatabaseFactory;
use App\Exception\DatabaseException;
use App\Model\UserModel;
use PHPUnit\Framework\TestCase;

class UserModelTest extends TestCase
{
    /**
     * @return void
     * @throws DatabaseException
     */
    public function testDataUpdateWithoutId()
    {
        $users = self::dataProvider();
        $user = $users[0][0];

        $userModel = new UserModel(DatabaseFactory::getByEnv());

        unset($user['id']);

        $this->assertFalse($userModel->update($user));
    }

    /**
     * @throws DatabaseException
     */
    public function testDataUpdate()
    {
        $users = self::dataProvider();
        $user = $users[0][0];

        $userModel = new UserModel(DatabaseFactory::getByEnv());
        $userModel->update($user);
        $this->assertTrue(true);
    }

    /**
     * @return array[]
     */
    public static function dataProvider(): array
    {
        return
            [
                [
                    [
                        'id' => 1,
                        'name' => 'John',
                        'email' => 'john-studying@phpunit.com'
                    ],
                ],
                [
                    [
                        'id' => 2,
                        'name' => 'Angelina',
                        'email' => 'angelina-studying@phpunit.com'
                    ],
                ]
            ];
    }
}