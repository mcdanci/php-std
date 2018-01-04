<?php
use think\migration\Migrator;
use Phinx\Db\Adapter\MysqlAdapter;
use McDanci\ThinkPHP\Phinx;

class CreateOrderVisitorTable extends Migrator
{
    const KEY_PRIMARY = 'order_id';

    public function change()
    {
        $this->table('order_visitor', [
            Phinx::TABLE_ENGINE => Phinx::TABLE_ENGINE_INNO,

            Phinx::ID => false,
            Phinx::KEY_PRIMARY => self::KEY_PRIMARY,
        ])->addColumn(self::KEY_PRIMARY, Phinx::COL_TYP_INT, [Phinx::SIGNED => false])
            ->addColumn('ticket_type', Phinx::COL_TYP_INT, [
                Phinx::COL_OPT_LIMIT => MysqlAdapter::INT_TINY,
                Phinx::COL_OPT_NULL => false,
                Phinx::COMMENT => '{1: single, 2: both}'
            ])
            ->create();
    }
}
