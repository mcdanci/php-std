<?php
use think\migration\Migrator;
use McDanci\ThinkPHP\Phinx;
use \Phinx\Db\Adapter\MysqlAdapter;

class CreateRegTable extends Migrator
{
    /**
     * Create table for registrant information in common.
     * @todo Set `id(10)` into `unsigned`, `iso3166 zerofill`
     * @todo Set `iso3166` into `zerofill` or mod. business logic
     * @todo Opt. `password` with limitation
     * @todo Opt. in all
     */
    public function change()
    {
        $this->table('reg', [
            Phinx::TABLE_COLLATION => Phinx::TABLE_COLLATION_U8MG,
            Phinx::COMMENT => 'Registrant information in common',
            Phinx::SIGNED => false,
        ])
            ->addColumn(Phinx::CREATED, Phinx::COL_TYP_DATETIME, [Phinx::COL_OPT_NULL => false])
            //->addColumn(Phinx::UPDATED, Phinx::COL_TYP_DATETIME, [Phinx::COL_OPT_NULL => true])
            ->addColumn(Phinx::DELETED, Phinx::COL_TYP_DATETIME, [Phinx::COL_OPT_NULL => true])

            ->addColumn('type', Phinx::COL_TYP_INT, [
                Phinx::COL_OPT_LIMIT => MysqlAdapter::INT_TINY,
                Phinx::SIGNED => false,
                Phinx::COL_OPT_NULL => false,
                Phinx::COMMENT => 'Role type {1: exhibitor, 2: visitor, 3: admin}',
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
                Phinx::COL_OPT_NULL => false,
            ])
            ->addIndex(['type'])
            ->create();
    }
}
