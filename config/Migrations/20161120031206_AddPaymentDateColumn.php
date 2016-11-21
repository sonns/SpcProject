<?php
use Migrations\AbstractMigration;

class AddPaymentDateColumn extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-change-method
     * @return void
     */
    public function change()
    {
        $table = $this->table('tbl_master_requests');
        $table->addColumn('payment_date', 'datetime',['default'=> "CURRENT_TIMESTAMP"])
            ->update();
    }
}
