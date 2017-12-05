<?php
use think\migration\Migrator;
use McDanci\ThinkPHP\Phinx;

class CreateUserTable extends Migrator
{
    /**
     * @link http://blog.csdn.net/wchinaw/article/details/6660107
     */
    public function change()
    {
        $table = $this->table('user', [
            Phinx::TABLE_COLLATION => Phinx::TABLE_COLLATION_U8MG,
            Phinx::TABLE_COMMENT => 'User',
            Phinx::SIGNED => false,
        ]);

        $table
            //->addTimestamps('created', 'updated')
            ->addColumn('created', Phinx::COL_TYP_DATETIME)
            ->addColumn('updated', Phinx::COL_TYP_DATETIME, [Phinx::COL_OPT_NULL => true])
            ->addColumn('deleted', Phinx::COL_TYP_DATETIME, [Phinx::COL_OPT_NULL => true])

            ->addColumn('username', Phinx::COL_TYP_STRING, [Phinx::COL_OPT_LIMIT => 320])
            ->addColumn('password', Phinx::COL_TYP_STRING, [Phinx::COL_OPT_LIMIT => 255])
            ->addColumn('reg_id', Phinx::COL_TYP_INT, [Phinx::COL_OPT_COMMENT => 'Registrant id'])
            //->addForeignKey('id', 'reg_common', 'reg_id', [
            //    Phinx::COL_OPT_DELETE => Phinx::SET_NULL,
            //    Phinx::COL_OPT_UPDATE => Phinx::NO_ACTION,
            //]) // TODO
            ->create();

        //$columnList = $this->table('user')->getColumns(); // TODO: debug
    }
}
