<?php
use think\migration\Migrator;
use McDanci\ThinkPHP\Phinx;
use \Phinx\Db\Adapter\MysqlAdapter;

class CreateMemberVisitorTable extends Migrator
{
    const KEY_PRIMARY = 'member_id';

    /**
     * Create table for member information of visitor.
     * @todo Opt. in all
     */
    public function change()
    {
        $this->table('member_visitor', [
            Phinx::TABLE_COLLATION => Phinx::TABLE_COLLATION_U8MG,
            Phinx::COMMENT => 'Member information of visitor',
            Phinx::ID => false,
            Phinx::KEY_PRIMARY => self::KEY_PRIMARY,
        ])->addColumn(self::KEY_PRIMARY, Phinx::COL_TYP_INT, [
            Phinx::SIGNED => false,
            Phinx::COL_OPT_NULL => true,
        ])
            ->addColumn('cat', Phinx::COL_TYP_STRING, [
                Phinx::COL_OPT_NULL => true,
                Phinx::COMMENT => 'Category',
            ])
            ->addColumn('job_function', Phinx::COL_TYP_STRING, [
                Phinx::COL_OPT_LIMIT => 255,
                Phinx::COL_OPT_NULL => false,
                Phinx::COMMENT => 'Job function',
            ])
            ->addColumn('brand', Phinx::COL_TYP_INT, [
                Phinx::COL_OPT_LIMIT => MysqlAdapter::INT_TINY,
                Phinx::SIGNED => false,
                Phinx::COL_OPT_NULL => true,
                Phinx::COMMENT => 'Brand',
            ])
            ->addColumn('f_man', Phinx::COL_TYP_INT, [
                Phinx::COL_OPT_LIMIT => MysqlAdapter::INT_TINY,
                Phinx::SIGNED => false,
                Phinx::COL_OPT_NULL => true,
                Phinx::COMMENT => 'Footwear manufacturer',
            ])
            ->create();
    }
}
