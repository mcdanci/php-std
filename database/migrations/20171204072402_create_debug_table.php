<?php
use think\migration\Migrator;
use McDanci\ThinkPHP\Phinx;

class CreateDebugTable extends Migrator
{
    /**
     * Create table for debug.
     *
     * The following commands can be used in this method and Phinx will automatically reverse them when rolling back:
     * - createTable
     * - renameTable
     * - addColumn
     * - renameColumn
     * - addIndex
     * - addForeignKey
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working with the Table class.
     * @todo Set `id(10)` into `unsigned`
     */
    public function change()
    {
        $this->table('debug', [
            Phinx::TABLE_COLLATION => Phinx::TABLE_COLLATION_U8MG,

            Phinx::SIGNED => false,
        ])
            ->addColumn('k', Phinx::COL_TYP_STRING, [
                Phinx::COL_OPT_NULL => true,
                Phinx::COMMENT => 'Key',
            ])
            ->addColumn('body', Phinx::COL_TYP_TEXT, [
                Phinx::COL_OPT_NULL => true,
            ])
            ->create();
    }
}
