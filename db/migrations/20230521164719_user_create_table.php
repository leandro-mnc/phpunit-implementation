<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class UserCreateTable extends AbstractMigration
{
    public function up(): void
    {
        $table = $this->table('user');
        $table->addColumn('name', 'string', ['limit' => 100])
            ->addColumn('email', 'string', ['limit' => 100])
            ->addColumn('created', 'timestamp', ['default' => 'CURRENT_TIMESTAMP'])
            ->create();
    }

    public function down(): void
    {
        $this->table('user')->drop()->save();
    }
}
