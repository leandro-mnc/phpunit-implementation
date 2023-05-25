<?php
declare(strict_types=1);

namespace Tests\Feature;

use App\Database\DatabaseFactory;
use App\Database\DatabaseInterface;
use App\Exception\AlreadyExistsException;
use App\Exception\DatabaseException;
use App\Model\UserModel;
use App\Service\User\CreateService;
use PHPUnit\Framework\TestCase;

final class UserTest extends TestCase
{
    /**
     * @dataProvider dataProvider
     * @throws \App\Exception\DatabaseException
     * @throws AlreadyExistsException
     */
    public function testUserCreate(array $user)
    {
        $database = $this->getDatabase();

        $model = new UserModel($database);

        $service = new CreateService($model);

        $this->assertTrue($service->create($user) > 0);
    }

    /**
     * @throws AlreadyExistsException
     * @throws DatabaseException
     */
    public function testUserCreateError()
    {
        $database = $this->getDatabase();

        $model = new UserModel($database);

        $service = new CreateService($model);

        $user = ['name' => 'Michael'];

        $this->assertFalse($service->create($user) > 0);
    }

    /**
     * @throws DatabaseException
     */
    public function testUserCreateEmailExists()
    {
        $database = $this->getDatabase();

        $model = new UserModel($database);

        $service = new CreateService($model);

        $users = self::dataProvider();

        $user = $users[0][0];

        try {
            $service->create($user);
            $this->fail();
        } catch (AlreadyExistsException $ex) {
            $this->assertTrue(true);
        }
    }

    /**
     * @
     * @return \App\Database\DatabaseInterface
     * @throws DatabaseException
     */
    public function getDatabase(): DatabaseInterface
    {
        return DatabaseFactory::getByEnv();
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
                        'name' => 'John',
                        'email' => 'john-studying@phpunit.com'
                    ],
                ],
                [
                    [
                        'name' => 'Angelina',
                        'email' => 'angelina-studying@phpunit.com'
                    ],
                ]
            ];
    }
}