<?php
use think\migration\Migrator;
use McDanci\ThinkPHP\Phinx;
use Phinx\Db\Adapter\MysqlAdapter;

class CreateMemberTable extends Migrator
{
    /**
     * Create table for member.
     * @link http://blog.csdn.net/wchinaw/article/details/6660107
     * @link http://php.net/manual/zh/book.password.php
     * @todo Set primary key into `unsigned`
     * @todo Role 機制
     * @todo `reg_id` 作外键
     * @todo
     */
    public function change()
    {
        $this->table('member', [
            Phinx::TABLE_COLLATION => Phinx::TABLE_COLLATION_U8MG,
            Phinx::SIGNED => false,
        ])
            //->addTimestamps('created', 'updated')
            ->addColumn('created', Phinx::COL_TYP_DATETIME, [Phinx::COL_OPT_NULL => false])
            ->addColumn('updated', Phinx::COL_TYP_DATETIME, [Phinx::COL_OPT_NULL => true])
            ->addColumn('deleted', Phinx::COL_TYP_DATETIME, [Phinx::COL_OPT_NULL => true])

            ->addColumn('type', Phinx::COL_TYP_INT, [
                Phinx::COL_OPT_LIMIT => MysqlAdapter::INT_TINY,
                Phinx::SIGNED => false,
                Phinx::COL_OPT_NULL => false,
                Phinx::COL_OPT_DEFAULT => 1,
                Phinx::COMMENT => 'Role type {1: exhibitor, 2: visitor}',
            ])
            ->addColumn('name_first', Phinx::COL_TYP_STRING, [
                Phinx::COL_OPT_NULL => false,
                Phinx::COMMENT => 'First name',
            ])
            ->addColumn('name_last', Phinx::COL_TYP_STRING, [
                Phinx::COL_OPT_NULL => false,
                Phinx::COMMENT => 'Last name',
            ])
            ->addColumn('gender', Phinx::COL_TYP_INT, [
                Phinx::COL_OPT_LIMIT => MysqlAdapter::INT_TINY,
                Phinx::SIGNED => false,
                Phinx::COL_OPT_NULL => false,
                Phinx::COL_OPT_DEFAULT => 1,
                Phinx::COMMENT => 'Gender: {1: Mrs., 2: Mr., 3: Ms.}',
            ])
            ->addColumn('email', Phinx::COL_TYP_STRING, [
                Phinx::COL_OPT_LIMIT => 320,
                Phinx::COL_OPT_NULL => false,
                Phinx::COMMENT => 'As username',
            ])
            ->addColumn('tel', Phinx::COL_TYP_STRING, [
                Phinx::COL_OPT_NULL => true,
                Phinx::COMMENT => 'Telephone',
            ])
            ->addColumn('tel_cell', Phinx::COL_TYP_STRING, [
                Phinx::COL_OPT_LIMIT => 255,
                Phinx::COL_OPT_NULL => false,
                Phinx::COMMENT => 'Cell phone',
            ])
            ->addColumn('company', Phinx::COL_TYP_STRING, [
                Phinx::COL_OPT_NULL => false,
                Phinx::COMMENT => 'Company name',
            ])
            ->addColumn('street', Phinx::COL_TYP_STRING, [
                Phinx::COL_OPT_NULL => false,
            ])
            ->addColumn('city', Phinx::COL_TYP_STRING, [
                Phinx::COL_OPT_NULL => false,
            ])
            ->addColumn('state', Phinx::COL_TYP_STRING, [
                Phinx::COL_OPT_NULL => false,
                Phinx::COMMENT => 'State (required for U.S. and Canada only)',
            ])
            ->addColumn('zip', Phinx::COL_TYP_STRING, [
                Phinx::COL_OPT_NULL => false,
                Phinx::COMMENT => 'ZIP code',
            ])
            ->addColumn('iso3166', Phinx::COL_TYP_INT, [
                Phinx::COL_OPT_LIMIT => MysqlAdapter::INT_SMALL,
                Phinx::SIGNED => false,
                Phinx::COL_OPT_NULL => false,
                Phinx::COMMENT => 'Country code',
            ])
            ->addColumn('website', Phinx::COL_TYP_TEXT, [
                Phinx::COL_OPT_NULL => false,
                Phinx::COMMENT => 'Company website',
            ])
            ->addColumn('cat', Phinx::COL_TYP_STRING, [
                Phinx::COL_OPT_NULL => true,
                Phinx::COMMENT => 'Category',
            ])
            ->addColumn('password', Phinx::COL_TYP_STRING, [
                Phinx::COL_OPT_LIMIT => 255,
                Phinx::COL_OPT_NULL => true,
            ])

            ->addColumn('reg_common_id', Phinx::COL_TYP_INT, [
                Phinx::SIGNED => false,
                Phinx::COL_OPT_NULL => true,
                Phinx::COMMENT => 'Registrant id',
            ])

            // TODO: debug
            //->addColumn('login_status', 'boolean', array('limit' => 1, 'default' => 0, 'comment' => '登陆状态'))
            //->addColumn('login_code', 'string', array('limit' => 32, 'default' => 0, 'comment' => '排他性登陆标识'))
            //->addColumn('last_login_ip', 'integer', array('limit' => 11, 'default' => 0, 'comment' => '最后登录IP'))
            //->addColumn('last_login_time', 'datetime', array('default' => 0, 'comment' => '最后登录时间'))
            ->addIndex(['type'])
            ->create();
    }
}
