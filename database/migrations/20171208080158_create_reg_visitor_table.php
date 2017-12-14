<?php
use think\migration\Migrator;
use McDanci\ThinkPHP\Phinx;

class CreateRegVisitorTable extends Migrator
{
    /**
     * Create table for registrant information of visitor.
     * @todo Set `id(10)` into `unsigned`
     */
    public function change()
    {
        $this->table('reg_visitor', [
            Phinx::TABLE_COLLATION => Phinx::TABLE_COLLATION_U8MG,
            Phinx::COMMENT => 'Registrant information of visitor',
            Phinx::SIGNED => false,
        ])
            ->create();
    }
}
