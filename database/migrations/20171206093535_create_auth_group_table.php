<?php
use think\migration\Migrator;
use McDanci\ThinkPHP\Phinx;

class CreateAuthGroupTable extends Migrator
{
    /**
     * Create authentication group table.
     */
    public function change()
    {
        $this->table('auth_group', [
            Phinx::TABLE_ENGINE => Phinx::TABLE_ENGINE_MY_ISAM,
            Phinx::TABLE_COLLATION => Phinx::TABLE_COLLATION_U8MG,
            Phinx::COMMENT => 'Authentication group，用户组表',
            Phinx::SIGNED => false,
        ])
            ->addColumn('title', Phinx::COL_TYP_STRING, [
                Phinx::COL_OPT_LIMIT => 100,
                Phinx::COL_OPT_NULL => true,
                Phinx::COL_OPT_DEFAULT => '', // TODO
                Phinx::COMMENT => '', // TODO
            ])
            ->create();
    }
}
