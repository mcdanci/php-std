<?php
use think\migration\Migrator;
use McDanci\ThinkPHP\Phinx;

class CreateDebugTable extends Migrator
{
    /**
     * Create the debug table.
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
            ->addColumn('k', Phinx::COL_TYP_STRING, [Phinx::COMMENT => 'Key'])
            ->addColumn('body', Phinx::COL_TYP_TEXT, [Phinx::COMMENT => '内容主体'])
            ->create();
    }
}
