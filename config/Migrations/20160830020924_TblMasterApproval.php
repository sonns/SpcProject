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
            'autoIncrement' => true,
            'default' => null,
            'limit' => 11,
            'null' => false,
        ]);
        $requests->addColumn('user_id', 'integer')
            ->addColumn('req_id', 'integer')
            ->addColumn('del_flg', 'integer', array('limit' => 1,'default'=>0))
            ->addColumn('created', 'datetime',['default'=> "CURRENT_TIMESTAMP"])
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
                'req_id',
                'tbl_master_requests',
                'id',
                [
                    'update' => 'CASCADE',
                    'delete' => 'CASCADE'
                ]
            )
            ->addIndex(
                [
                    'req_id',
                ]
            )->save();
    }
    public function down()
    {
        $this->table('tbl_master_requests')->dropForeignKey(['req_id']);
        $this->table('tbl_master_approval')->drop();
    }
}