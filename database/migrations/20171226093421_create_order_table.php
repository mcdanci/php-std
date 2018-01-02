<?php
use think\migration\Migrator;
use McDanci\ThinkPHP\Phinx;

class CreateOrderTable extends Migrator
{
    /**
     * Create table of order.
     * @todo Set `id(10)` into `unsigned`
     */
    public function change()
    {
        $this->table('order', [
            Phinx::TABLE_ENGINE => Phinx::TABLE_ENGINE_INNO,

            Phinx::SIGNED => false,
        ])
            ->addColumn(Phinx::CREATED, Phinx::COL_TYP_DATETIME, [Phinx::COL_OPT_NULL => false])
            ->addColumn(Phinx::UPDATED, Phinx::COL_TYP_DATETIME, [Phinx::COL_OPT_NULL => true])
            ->addColumn(Phinx::DELETED, Phinx::COL_TYP_DATETIME, [Phinx::COL_OPT_NULL => true])

            ->addColumn('reg_id', Phinx::COL_TYP_INT, [
                Phinx::SIGNED => false,
                Phinx::COL_OPT_NULL => false,
            ])
            ->addColumn('receipt_img_file', Phinx::COL_TYP_STRING, [
                Phinx::COL_OPT_NULL => true,
                Phinx::COMMENT => '水单',
            ])
            ->addColumn('bank_account_name', Phinx::COL_TYP_STRING, [
                Phinx::COL_OPT_NULL => true,
            ])
            ->addColumn('exhibitor_pay_deadline', Phinx::COL_TYP_DATETIME, [
                Phinx::COL_OPT_NULL => true,
            ])
            ->addColumn('status', \McDanci\ThinkPHP\Phinx::COL_TYP_INT, [
                Phinx::COL_OPT_LIMIT => \Phinx\Db\Adapter\MysqlAdapter::INT_TINY,
                Phinx::COL_OPT_NULL => false,
                Phinx::COL_OPT_DEFAULT => 1,
                Phinx::COMMENT => 'Status {0: invalid, 1: unpaid, 2: receipt uploaded}',
            ])
            ->addColumn('amount', Phinx::COL_TYP_DECIMAL, [
                Phinx::COL_OPT_PRECISION => 10,
                Phinx::COL_OPT_SCALE => 2,
                Phinx::COMMENT => '交易额',
            ]) // TODO: 可忽略？
            ->addIndex('reg_id')
            ->create();
    }
}
