<?php
use think\migration\Migrator;
use McDanci\ThinkPHP\Phinx;

class CreateAuthRuleTable extends Migrator
{
    /**
     * Create authentication rule table.
     */
    public function change()
    {
        $this->table('auth_rule', [
            Phinx::TABLE_ENGINE => Phinx::TABLE_ENGINE_MY_ISAM,
            Phinx::TABLE_COLLATION => Phinx::TABLE_COLLATION_U8MG,
            Phinx::COMMENT => 'Authentication rule，规则表',
            Phinx::SIGNED => false,
        ])
            ->addColumn('name', Phinx::COL_TYP_STRING, [
                Phinx::COL_OPT_LIMIT => 80,
                Phinx::COL_OPT_NULL => true,
                Phinx::COL_OPT_DEFAULT => '', // TODO
                Phinx::COMMENT => '规则唯一标识',
            ])
            ->addColumn('title', Phinx::COL_TYP_STRING, [
                Phinx::COL_OPT_LIMIT => 20,
                Phinx::COL_OPT_NULL => true,
                Phinx::COL_OPT_DEFAULT => '', // TODO
                Phinx::COMMENT => '规则名称',
            ])
            ->addColumn('type', Phinx::COL_TYP_INT, [
                Phinx::COL_OPT_LIMIT => 1,
                Phinx::COL_OPT_NULL => true,
                Phinx::COL_OPT_DEFAULT => 1,
                Phinx::COMMENT => '', // TODO
            ])
            ->addColumn('status', Phinx::COL_TYP_INT, [
                Phinx::COL_OPT_LIMIT => 1,
                Phinx::COL_OPT_NULL => true,
                Phinx::COL_OPT_DEFAULT => 1,
                Phinx::COMMENT => '状态 {1: "Enabled", 0: "Disabled"}',
            ])
            ->addColumn('condition', Phinx::COL_TYP_STRING, [
                Phinx::COL_OPT_LIMIT => 100,
                Phinx::COL_OPT_NULL => true,
                Phinx::COL_OPT_DEFAULT => '', // TODO
                Phinx::COMMENT => '规则附加条件表达式：为空表示存在就验证，不为空表示按照条件验证；满足附加条件的规则，才被认为是有效的规则', // TODO
            ])
            ->addIndex(['name'], [Phinx::IDX_OPT_UNIQUE => true])
            ->create();
    }
}
