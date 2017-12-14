<?php
use think\migration\Migrator;
use McDanci\ThinkPHP\Phinx;
use Phinx\Db\Adapter\MysqlAdapter;

class CreateRegVisitorTable extends Migrator
{
    /**
     * Create table for registrant information of visitor.
     * @todo Set `id(10)` into `unsigned`
     * @todo Opt. in all
     */
    public function change()
    {
        $this->table('reg_visitor', [
            Phinx::TABLE_COLLATION => Phinx::TABLE_COLLATION_U8MG,
            Phinx::COMMENT => 'Registrant information of visitor',
            Phinx::ID => 'common_id',
            Phinx::SIGNED => false,
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
