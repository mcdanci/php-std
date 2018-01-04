<?php
use think\migration\Migrator;
use Phinx\Db\Adapter\MysqlAdapter;
use McDanci\ThinkPHP\Phinx;

class CreateRegExhibitorStaffTable extends Migrator
{
    const KEY_PRIMARY = 'order_id';

    public function change()
    {
        $this->table('reg_exhibitor_staff', [
            Phinx::TABLE_ENGINE => Phinx::TABLE_ENGINE_INNO,

            Phinx::ID => false,
            Phinx::KEY_PRIMARY => [
                self::KEY_PRIMARY,
                'seq',
            ],
        ])
            ->addColumn(self::KEY_PRIMARY, Phinx::COL_TYP_INT, [Phinx::SIGNED => false])
            ->addColumn('seq', Phinx::COL_TYP_INT, [
                Phinx::COL_OPT_LIMIT => MysqlAdapter::INT_TINY,
                Phinx::SIGNED => false,
                Phinx::COL_OPT_NULL => false,
                Phinx::COL_OPT_DEFAULT => 1,
            ])

            ->addColumn(Phinx::CREATED, Phinx::COL_TYP_DATETIME, [Phinx::COL_OPT_NULL => false])
            ->addColumn(Phinx::UPDATED, Phinx::COL_TYP_DATETIME, [Phinx::COL_OPT_NULL => true])
            ->addColumn(Phinx::DELETED, Phinx::COL_TYP_DATETIME, [Phinx::COL_OPT_NULL => true])

            ->addColumn('name_full', Phinx::COL_TYP_STRING, [
                Phinx::COL_OPT_NULL => true,
            ])
            ->addColumn('position', Phinx::COL_TYP_STRING, [
                Phinx::COL_OPT_NULL => true,
            ])
            ->addColumn('email', Phinx::COL_TYP_STRING, [
                Phinx::COL_OPT_NULL => false,
            ])
            ->create();
    }
}
