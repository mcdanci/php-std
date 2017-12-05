<?php

use think\migration\Migrator;
use think\migration\db\Column;
use McDanci\ThinkPHP\Phinx;

class CreateUserTable extends Migrator
{
    /**
     * @link http://blog.csdn.net/wchinaw/article/details/6660107
     */
    public function change()
    {
        $this->table('user', [
            Phinx::TABLE_COLLATION => Phinx::TABLE_COLLATION_U8MG,
            Phinx::TABLE_COMMENT => 'User',
            Phinx::TABLE_SIGNED => false,
        ])
            ->addColumn('username', Phinx::COL_TYP_STRING, ['limit' => 320])
            ->addColumn('password', Phinx::COL_TYP_STRING, ['limit' => 255])
            ->create();
    }
}
