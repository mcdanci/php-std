<?php
use think\migration\Migrator;
use McDanci\ThinkPHP\Phinx;

/**
 * Class CreateAuthGroupTable
 * @see \think\Auth
 */
class CreateAuthGroupTable extends Migrator
{
    /**
     * Create authentication group table.
     * @todo
     */
    public function change()
    {
        $this->table('auth_group', [
            Phinx::TABLE_ENGINE => Phinx::TABLE_ENGINE_MY_ISAM,
            Phinx::TABLE_COLLATION => Phinx::TABLE_COLLATION_U8MG,
            Phinx::COMMENT => 'Authentication group，用户组',
            Phinx::SIGNED => false,
        ])
            ->addColumn('title', Phinx::COL_TYP_STRING, [
                Phinx::COL_OPT_LIMIT => 100,
                Phinx::COL_OPT_NULL => false,
                Phinx::COL_OPT_DEFAULT => '', // TODO
                Phinx::COMMENT => '用户组中文名称', // TODO
            ])
            ->addColumn('status', Phinx::COL_TYP_INT, [
                Phinx::COL_OPT_LIMIT => 1,
                Phinx::COL_OPT_NULL => false,
                Phinx::COL_OPT_DEFAULT => 1,
                Phinx::COMMENT => '状态 {1: "Enabled", 0: "Disabled"}',
            ])
            ->addColumn('rules', Phinx::COL_TYP_STRING, [
                Phinx::COL_OPT_LIMIT => 80,
                Phinx::COL_OPT_NULL => false,
                Phinx::COL_OPT_DEFAULT => '', // TODO
                Phinx::COMMENT => '用户组拥有的规则 id，多个规则用 `,` 隔开', // TODO
            ])
            ->create();
    }
}
