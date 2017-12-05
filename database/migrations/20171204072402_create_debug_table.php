<?php

use think\migration\Migrator;
use think\migration\db\Column;
use McDanci\ThinkPHP\Phinx;

class CreateDebugTable extends Migrator
{
    /**
     * Create the table.
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


        //$table = $this->table('user', ['engine' => 'MyISAM']);
        //
        //$table->addColumn('username', 'string',array('limit' => 15,'default'=>'','comment'=>'用户名，登陆使用'))
        //    ->addColumn('password', 'string',array('limit' => 32,'default'=>md5('123456'),'comment'=>'用户密码'))
        //    ->addColumn('login_status', 'boolean',array('limit' => 1,'default'=>0,'comment'=>'登陆状态'))
        //    ->addColumn('login_code', 'string',array('limit' => 32,'default'=>0,'comment'=>'排他性登陆标识'))
        //    ->addColumn('last_login_ip', 'integer',array('limit' => 11,'default'=>0,'comment'=>'最后登录IP'))
        //    ->addColumn('last_login_time', 'datetime',array('default'=>0,'comment'=>'最后登录时间'))
        //    ->addColumn('is_delete', 'boolean',array('limit' => 1,'default'=>0,'comment'=>'删除状态，1已删除'))
        //    ->addIndex(array('username'), array('unique' => true))
        //    ->create();

        $table = $this->table('debug', [
            Phinx::TABLE_COMMENT => 'Debug',
            Phinx::TABLE_COLLATION => Phinx::TABLE_COLLATION_U8MG,
            Phinx::TABLE_SIGNED => false,
        ]);
        $table
            //->addColumn('id', 'integer', ['limit' => 11])
            ->addColumn('body', 'text')

            // TODO: debug

            ->addColumn('username', 'string', ['limit' => 40])

            ->addColumn('created', 'datetime')
            ->addColumn('updated', 'datetime', ['null' => true])
            ->addColumn('time_debug', 'timestamp', ['default' => 'CURRENT_TIMESTAMP'])
            ->addIndex(['username'], ['unique' => true])

            ->create();
    }
}
