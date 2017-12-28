<?php
use think\migration\Migrator;
use McDanci\ThinkPHP\Phinx;

class CreateOrderExhibitorBoothTable extends Migrator
{
    const KEY_PRIMARY = 'order_id';

    /**
     * Create table of order for exhibitor.
     * @todo Set `id(10)` into `unsigned`
     */
    public function change()
    {
        $this->table('order_exhibitor_booth', [
            Phinx::TABLE_ENGINE => Phinx::TABLE_ENGINE_INNO,

            Phinx::ID => false,
            Phinx::KEY_PRIMARY => self::KEY_PRIMARY,
        ])->addColumn(self::KEY_PRIMARY, Phinx::COL_TYP_INT, [Phinx::SIGNED => false])
            ->addColumn('booth_id', Phinx::COL_TYP_INT, [
                Phinx::COL_OPT_NULL => false,
            ])
            ->create();
    }
}
