<?php
use think\migration\Migrator;
use McDanci\ThinkPHP\Phinx;

class CreateBoothTable extends Migrator
{
    const KEY_PRIMARY = 'id';

    /**
     * Create table for registrant information in common.
     * @todo Set `id(10)` into `unsigned`
     */
    public function change()
    {
        $this->table('booth', [
            Phinx::TABLE_COLLATION => Phinx::TABLE_COLLATION_U8MG,
            Phinx::ID => false,
            Phinx::KEY_PRIMARY => self::KEY_PRIMARY,
        ])->addColumn(self::KEY_PRIMARY, Phinx::COL_TYP_INT, [
            Phinx::SIGNED => false,
            Phinx::COL_OPT_NULL => true,
        ])
            ->addColumn('x', Phinx::COL_TYP_FLOAT, [
                Phinx::COL_OPT_NULL => false,
                Phinx::COMMENT => '横坐标',
            ])
            ->addColumn('y', Phinx::COL_TYP_FLOAT, [
                Phinx::COL_OPT_NULL => false,
                Phinx::COMMENT => '纵坐标',
            ])
            ->addColumn('zone', Phinx::COL_TYP_INT)
            ->create();
    }
}
