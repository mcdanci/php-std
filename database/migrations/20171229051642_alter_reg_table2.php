<?php
use think\migration\Migrator;
use McDanci\ThinkPHP\Phinx;
use Phinx\Db\Adapter\MysqlAdapter;

class AlterRegTable2 extends Migrator
{
    /**
     * Add column for registrant agreement.
     * @todo comment
     */
    public function change()
    {
        $this->table('reg')
            ->addColumn('agreement', Phinx::COL_TYP_INT, [
                Phinx::COL_OPT_LIMIT => MysqlAdapter::INT_TINY,
                Phinx::COL_OPT_NULL => false,
                Phinx::COL_OPT_DEFAULT => 1,
                Phinx::COMMENT => 'Agreement {1: unread, 2: read}',
            ])
            ->update();
    }
}
