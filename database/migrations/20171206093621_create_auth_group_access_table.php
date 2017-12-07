<?php
use think\migration\Migrator;
use McDanci\ThinkPHP\Phinx;

/**
 * Class CreateAuthGroupAccessTable
 * @see \think\Auth
 */
class CreateAuthGroupAccessTable extends Migrator
{
    /**
     * Create authentication group access table.
     */
    public function change()
    {
        $this->table('auth_group_access', [
            Phinx::TABLE_ENGINE => Phinx::TABLE_ENGINE_MY_ISAM,
            Phinx::TABLE_COLLATION => Phinx::TABLE_COLLATION_U8MG,
            Phinx::COMMENT => 'Authentication group access，用户组明细',
            Phinx::SIGNED => false,
        ])
            ->addColumn('uid', Phinx::COL_TYP_INT, [
                Phinx::COL_OPT_LIMIT => 8,
                Phinx::SIGNED => false,
                Phinx::COL_OPT_NULL => false,
                Phinx::COMMENT => 'User id',
            ])
            ->addColumn('group_id', Phinx::COL_TYP_INT, [
                Phinx::COL_OPT_LIMIT => 8,
                Phinx::SIGNED => false,
                Phinx::COL_OPT_NULL => false,
                Phinx::COMMENT => '用户组 id', // TODO
            ])
            ->addIndex(['uid'])
            ->addIndex(['group_id'])
            ->addIndex(['uid', 'group_id'], [
                Phinx::IDX_OPT_NAME => 'uid_group_id',
                Phinx::IDX_OPT_UNIQUE => true,
            ])
            ->create();
    }
}
