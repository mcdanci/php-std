<?php
use think\migration\Migrator;
use McDanci\ThinkPHP\Phinx;

class CreateDebugTable extends Migrator
{
    /**
     * Create debug table.
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
     */
    public function change()
    {
        $this->table('debug', [
            Phinx::TABLE_COLLATION => Phinx::TABLE_COLLATION_U8MG,
            Phinx::SIGNED => false,
        ])
            ->addColumn('k', Phinx::COL_TYP_STRING, [Phinx::COMMENT => 'Key', Phinx::COL_OPT_NULL => true])
            ->addColumn('body', Phinx::COL_TYP_TEXT, [Phinx::COMMENT => '内容主体', Phinx::COL_OPT_NULL => true])
            ->create();
    }
}
