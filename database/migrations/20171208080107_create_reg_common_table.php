<?php
use think\migration\Migrator;
use McDanci\ThinkPHP\Phinx;

class CreateRegCommonTable extends Migrator
{
    /**
     * @todo Opt. column type
     */
    public function change()
    {
        $this->table('reg_common', [
            Phinx::TABLE_COLLATION => Phinx::TABLE_COLLATION_U8MG,
            Phinx::COMMENT => 'Registrant information in common',
            Phinx::SIGNED => false,
        ])
            ->addColumn('created', Phinx::COL_TYP_DATETIME, [Phinx::COL_OPT_NULL => false])
            ->addColumn('updated', Phinx::COL_TYP_DATETIME, [Phinx::COL_OPT_NULL => true])
            ->addColumn('deleted', Phinx::COL_TYP_DATETIME, [Phinx::COL_OPT_NULL => true])

            ->addColumn('type', Phinx::COL_TYP_INT_SMALL, [
                Phinx::COL_OPT_NULL => false,
                Phinx::COL_OPT_DEFAULT => 1,
                Phinx::COMMENT => 'Role type {1: exhibitor, 2: visitor, 3: admin}',
            ])
            ->addColumn('name_first', Phinx::COL_TYP_STRING, [
                Phinx::COL_OPT_LIMIT => 255,
                Phinx::COL_OPT_NULL => false,
                Phinx::COMMENT => 'First name',
            ])
            ->addColumn('name_last', Phinx::COL_TYP_STRING, [
                Phinx::COL_OPT_LIMIT => 255,
                Phinx::COL_OPT_NULL => false,
                Phinx::COMMENT => 'Last name',
            ])
            ->addColumn('gender', Phinx::COL_TYP_INT, [
                Phinx::SIGNED => false,
                Phinx::COL_OPT_LIMIT => 1,
                Phinx::COL_OPT_NULL => false,
                Phinx::COL_OPT_DEFAULT => 1,
                Phinx::COMMENT => 'Gender: {1: Mrs., 2: Mr., 3: Ms.}',
            ]) /* @see app/api/extra/option-gender.php */
            ->addColumn('email', Phinx::COL_TYP_STRING, [
                Phinx::COL_OPT_LIMIT => 255,
                Phinx::COL_OPT_NULL => false,
            ])
            ->addColumn('tel', Phinx::COL_TYP_STRING, [
                Phinx::COL_OPT_LIMIT => 255,
                Phinx::COL_OPT_NULL => true,
                Phinx::COMMENT => 'Telephone',
            ])
            ->addColumn('tel_cell', Phinx::COL_TYP_STRING, [
                Phinx::COL_OPT_LIMIT => 255,
                Phinx::COL_OPT_NULL => false,
                Phinx::COMMENT => 'Cell phone',
            ])
            ->addColumn('company', Phinx::COL_TYP_STRING, [
                Phinx::COL_OPT_LIMIT => 255,
                Phinx::COL_OPT_NULL => false,
                Phinx::COMMENT => 'Company name',
            ])
            ->addColumn('street', Phinx::COL_TYP_STRING, [
                Phinx::COL_OPT_LIMIT => 255,
                Phinx::COL_OPT_NULL => false,
            ])
            ->addColumn('city', Phinx::COL_TYP_STRING, [
                Phinx::COL_OPT_LIMIT => 255,
                Phinx::COL_OPT_NULL => false,
            ])
            ->addColumn('state', Phinx::COL_TYP_STRING, [
                Phinx::COL_OPT_LIMIT => 255,
                Phinx::COL_OPT_NULL => true,
                Phinx::COMMENT => 'State (required for U.S. and Canada only)',
            ])
            ->addColumn('zip', Phinx::COL_TYP_STRING, [
                Phinx::COL_OPT_LIMIT => 255,
                Phinx::COL_OPT_NULL => true,
                Phinx::COMMENT => 'Zip code',
            ])
            ->addColumn('iso3166', Phinx::COL_TYP_INT_SMALL, [
                Phinx::COL_OPT_LIMIT => 3,
                Phinx::SIGNED => false,
                Phinx::COL_OPT_NULL => true,
                Phinx::COL_OPT_DEFAULT => 0,
                Phinx::COMMENT => 'Country',
            ]) // TODO: zerofill
            ->addColumn('website', Phinx::COL_TYP_TEXT, [
                Phinx::COL_OPT_NULL => false,
                Phinx::COMMENT => 'Company website',
            ])
            ->addColumn('cat', Phinx::COL_TYP_STRING, [
                Phinx::COL_OPT_LIMIT => 255,
                Phinx::COL_OPT_NULL => true,
                Phinx::COMMENT => 'Category',
            ]) // TODO
            ->addColumn('password', Phinx::COL_TYP_TEXT, [
                Phinx::COL_OPT_NULL => false,
                Phinx::COMMENT => 'Password (after confirm)',
            ])
            ->addIndex(['type'])
            ->create();
    }
}