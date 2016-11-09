<?php
use Migrations\AbstractMigration;

class TblMasterComments extends AbstractMigration
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
        $tblActi = $this->table('tbl_master_comments', [
            'id' => false,
            'primary_key' => ['id']
        ]);
        $tblActi->addColumn('id', 'integer', [
            'autoIncrement' => true,
            'default' => null,
            'limit' => 11,
            'null' => false,
        ])
            ->addPrimaryKey(['id'])
            ->addColumn('from_user_id', 'integer')
            ->addColumn('req_id', 'integer')
            ->addColumn('contents', 'text')
            ->addColumn('del_flg', 'integer', array('limit' => 1))
            ->addColumn('created', 'datetime',['default'=> "CURRENT_TIMESTAMP"])
            ->addForeignKey( 'from_user_id',
                'tbl_master_users',
                'id',
                [
                    'update' => 'CASCADE',
                    'delete' => 'CASCADE'
                ])
            ->addForeignKey( 'req_id',
                'tbl_master_requests',
                'id',
                [
                    'update' => 'CASCADE',
                    'delete' => 'CASCADE'
                ])
            ->save();
    }
    public function down()
    {
        $this->table('tbl_master_users')->dropForeignKey(['from_user_id']);
        $this->table('tbl_master_requests')->dropForeignKey(['req_id']);
        $this->table('tbl_master_comments')->drop();
    }
}
