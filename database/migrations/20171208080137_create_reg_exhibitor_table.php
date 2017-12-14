<?php
use think\migration\Migrator;
use McDanci\ThinkPHP\Phinx;

class CreateRegExhibitorTable extends Migrator
{
    /**
     * Create table for registrant information of exhibitor.
     * @todo Set `id(10)` into `unsigned`
     */
    public function change()
    {
        $this->table('reg_exhibitor', [
            Phinx::TABLE_COLLATION => Phinx::TABLE_COLLATION_U8MG,
            Phinx::COMMENT => 'Registrant information of exhibitor',
            Phinx::SIGNED => false,
        ])
            ->create();
    }
}
