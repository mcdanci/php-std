<?php
use think\migration\Migrator;
use McDanci\ThinkPHP\Phinx;

class AlterRegTable extends Migrator
{
    /**
     * Add column for registrant.
     * - `status`
     * - `reason`
     */
    public function change()
    {
        $this->table('reg')
            ->addColumn('status', \McDanci\ThinkPHP\Phinx::COL_TYP_INT, [
                Phinx::COL_OPT_LIMIT => \Phinx\Db\Adapter\MysqlAdapter::INT_TINY,
                Phinx::COL_OPT_NULL => false,
                Phinx::COL_OPT_DEFAULT => 1,
                Phinx::COMMENT => 'Status {1: unaudited, 2: audit passed, 3: audit declined}',
            ])->addColumn('reason', Phinx::COL_TYP_STRING, [
                Phinx::COL_OPT_NULL => true,
                Phinx::COMMENT => 'Audit decline reason',
            ])
            ->update();
    }
}
