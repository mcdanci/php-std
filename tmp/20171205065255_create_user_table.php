<?php
use think\migration\Migrator;
use McDanci\ThinkPHP\Phinx;

class CreateUserTable extends Migrator
{
    /**
     * Create user table.
     * @todo
     */
    public function change()
    {
        //$this->table('user', [
        //    Phinx::TABLE_COLLATION => Phinx::TABLE_COLLATION_U8MG,
        //    Phinx::SIGNED => false,
        //])
        //    //->addTimestamps('created', 'updated')
        //    ->addColumn('created', Phinx::COL_TYP_DATETIME) // TODO
        //    ->addColumn('updated', Phinx::COL_TYP_DATETIME, [Phinx::COL_OPT_NULL => true])
        //    ->addColumn('deleted', Phinx::COL_TYP_DATETIME, [Phinx::COL_OPT_NULL => true])
        //    ->addColumn('username', Phinx::COL_TYP_STRING, [Phinx::COL_OPT_LIMIT => 320])
        //    ->addColumn('password', Phinx::COL_TYP_STRING, [
        //        Phinx::COL_OPT_LIMIT => 255,
        //        Phinx::COMMENT => '密码',
        //    ])
        //    ->addColumn('reg_id', Phinx::COL_TYP_INT, [
        //        Phinx::COL_OPT_NULL => true,
        //        Phinx::COMMENT => 'Registrant id',
        //    ])
        //    //->addIndex(['username'], [Phinx::IDX_OPT_UNIQUE => true])
        //
        //    // TODO: `reg_id` 作外键
        //    //->addForeignKey('id', 'reg_common', 'reg_id', [
        //    //    Phinx::COL_OPT_DELETE => Phinx::SET_NULL,
        //    //    Phinx::COL_OPT_UPDATE => Phinx::NO_ACTION,
        //    //])
        //    ->create();
    }
}