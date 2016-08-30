<?php
use Migrations\AbstractMigration;

class TblMasterApproval extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-change-method
     * @return void
     */
    public function up()
    {
        $requests = $this->table('tbl_master_approval', [
            'id' => false
        ]);
        $requests->addColumn('user_id', 'integer')
            ->addColumn('dep_id', 'integer')
            ->addColumn('del_flg', 'integer', array('limit' => 1,'default'=>0))
            ->addColumn('created', 'datetime')
            ->addColumn('modified', 'datetime')
            ->addForeignKey(
                'user_id',
                'tbl_master_users',
                'id',
                [
                    'update' => 'CASCADE',
                    'delete' => 'CASCADE'
                ]
            )
            ->addForeignKey(
                'dep_id',
                'tbl_master_departments',
                'id',
                [
                    'update' => 'CASCADE',
                    'delete' => 'CASCADE'
                ]
            )
            ->addIndex(
                [
                    'dep_id',
                ]
            )->save();
    }
    public function down()
    {

        $this->table('tbl_master_approval')->drop();
    }
}