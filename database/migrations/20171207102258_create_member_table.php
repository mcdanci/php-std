<?php
use think\migration\Migrator;
use McDanci\ThinkPHP\Phinx;

class CreateMemberTable extends Migrator
{
    /**
     * Create member table.
     * @link http://blog.csdn.net/wchinaw/article/details/6660107
     * @todo Role 機制
     * @todo `reg_id` 作外键
     * @todo
     */
    public function change()
    {
        $this->table('member', [
            Phinx::TABLE_COLLATION => Phinx::TABLE_COLLATION_U8MG,
            Phinx::SIGNED => false, // TODO
        ])
            //->addTimestamps('created', 'updated')
            ->addColumn('created', Phinx::COL_TYP_DATETIME, [Phinx::COL_OPT_NULL => false])
            ->addColumn('updated', Phinx::COL_TYP_DATETIME, [Phinx::COL_OPT_NULL => true])
            ->addColumn('deleted', Phinx::COL_TYP_DATETIME, [Phinx::COL_OPT_NULL => true])

            ->addColumn('username', Phinx::COL_TYP_STRING, [
                Phinx::COL_OPT_LIMIT => 320,
                Phinx::COL_OPT_NULL => true,
            ])
            ->addColumn('password', Phinx::COL_TYP_STRING, [
                Phinx::COL_OPT_LIMIT => 255,
                Phinx::COL_OPT_NULL => true,
                Phinx::COMMENT => '密码',
            ])
            ->addColumn('reg_id', Phinx::COL_TYP_INT, [
                Phinx::COL_OPT_NULL => true,
                Phinx::COMMENT => 'Registrant id',
            ])

            // TODO: debug
            //->addColumn('login_status', 'boolean', array('limit' => 1, 'default' => 0, 'comment' => '登陆状态'))
            //->addColumn('login_code', 'string', array('limit' => 32, 'default' => 0, 'comment' => '排他性登陆标识'))
            //->addColumn('last_login_ip', 'integer', array('limit' => 11, 'default' => 0, 'comment' => '最后登录IP'))
            //->addColumn('last_login_time', 'datetime', array('default' => 0, 'comment' => '最后登录时间'))

            ->create();
    }
}
