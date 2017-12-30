<?php
use think\migration\Migrator;
use McDanci\ThinkPHP\Phinx;

class CreateStorageTable extends Migrator
{
    /**
     * @todo 單一本機儲存時 key = file_ref
     */
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

            ->addColumn('key', Phinx::COL_TYP_STRING, [
                Phinx::COL_OPT_NULL => false,
                Phinx::COMMENT => 'Storage object key',
            ])
            ->addColumn('file_ref', Phinx::COL_TYP_STRING, [
                Phinx::COL_OPT_NULL => false,
                Phinx::COMMENT => 'Storage object file reference',
            ])
            ->addColumn('o_filename', Phinx::COL_TYP_STRING, [
                Phinx::COL_OPT_NULL => false,
                Phinx::COMMENT => 'Original object file name',
            ])
            ->addIndex('key')
            ->create();
    }
}
