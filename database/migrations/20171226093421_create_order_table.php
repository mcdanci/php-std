<?php
use think\migration\Migrator;
use McDanci\ThinkPHP\Phinx;

class CreateOrderTable extends Migrator
{
    /**
     * Create table for order.
     * @todo Set `id(10)` into `unsigned`
     */
    public function change()
    {
        $this->table('Order', [
            Phinx::TABLE_ENGINE => Phinx::TABLE_ENGINE_INNO,
            Phinx::SIGNED => false,
        ])
            ->addColumn(Phinx::CREATED, Phinx::COL_TYP_DATETIME, [Phinx::COL_OPT_NULL => false])
            ->addColumn(Phinx::UPDATED, Phinx::COL_TYP_DATETIME, [Phinx::COL_OPT_NULL => true])
            ->addColumn(Phinx::DELETED, Phinx::COL_TYP_DATETIME, [Phinx::COL_OPT_NULL => true])

            ->create();
    }
}
