<?php
use think\migration\Migrator;
use McDanci\ThinkPHP\Phinx;

class CreateStorageTable extends Migrator
{
    public function change()
    {
        $this->table('storage', [
            Phinx::TABLE_COLLATION => Phinx::TABLE_COLLATION_U8MG,
            Phinx::COMMENT => 'Storage service',

            Phinx::SIGNED => false,
        ])
            ->addColumn(Phinx::CREATED, Phinx::COL_TYP_DATETIME, [Phinx::COL_OPT_NULL => false])
            ->addColumn(Phinx::UPDATED, Phinx::COL_TYP_DATETIME, [Phinx::COL_OPT_NULL => true])
            ->addColumn(Phinx::DELETED, Phinx::COL_TYP_DATETIME, [Phinx::COL_OPT_NULL => true])

            ->addColumn('') // TODO 调研 STORAGE object
            ->create();
    }
}
