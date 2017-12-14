<?php
use think\migration\Migrator;
use McDanci\ThinkPHP\Phinx;

class CreateRegExhibitorTable extends Migrator
{
    /**
     * Create table for registrant information of exhibitor.
     * @todo Set `id(10)` into `unsigned`
     * @todo Opt. in all
     */
    public function change()
    {
        $this->table('reg_exhibitor', [
            Phinx::TABLE_COLLATION => Phinx::TABLE_COLLATION_U8MG,
            Phinx::COMMENT => 'Registrant information of exhibitor',
            Phinx::ID => 'common_id',
            Phinx::SIGNED => false,
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
