<?php
use think\migration\Migrator;
use McDanci\ThinkPHP\Phinx;

class CreateRegExhibitorTable extends Migrator
{
    const KEY_PRIMARY = 'common_id';

    /**
     * Create table for registrant information of exhibitor.
     * @todo Opt. in all
     */
    public function change()
    {
        $this->table('reg_exhibitor', [
            Phinx::TABLE_COLLATION => Phinx::TABLE_COLLATION_U8MG,
            Phinx::COMMENT => 'Registrant information of exhibitor',
            Phinx::ID => false,
            Phinx::KEY_PRIMARY => self::KEY_PRIMARY,
        ])->addColumn(self::KEY_PRIMARY, Phinx::COL_TYP_INT, [
            Phinx::SIGNED => false,
            Phinx::COL_OPT_NULL => true,
        ])
            ->addColumn('c_opf', Phinx::COL_TYP_TEXT, [
                Phinx::COL_OPT_NULL => false,
                Phinx::COMMENT => 'Country(ies) with own production facility',
            ])
            ->addColumn('mpt', Phinx::COL_TYP_TEXT, [
                Phinx::COL_OPT_NULL => false,
                Phinx::COMMENT => 'Major product type(s)',
            ])
            ->addColumn('npe', Phinx::COL_TYP_TEXT, [
                Phinx::COL_OPT_NULL => true,
                Phinx::COMMENT => 'Specific new product(s) going to exhibit',
            ])
            ->addColumn('mc', Phinx::COL_TYP_TEXT, [
                Phinx::COL_OPT_NULL => true,
                Phinx::COMMENT => 'Major customer(s)',
            ])
            ->addColumn('tse', Phinx::COL_TYP_TEXT, [
                Phinx::COL_OPT_NULL => true,
                Phinx::COMMENT => 'Other trade shows exhibit with (if any)',
            ])
            ->create();
    }
}
