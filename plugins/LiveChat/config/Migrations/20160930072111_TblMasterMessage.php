<?php
use Migrations\AbstractMigration;

class TblMasterMessage extends AbstractMigration
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
        $tblMess = $this->table('tbl_master_message', [
            'id' => false,
            'primary_key' => ['id']
        ]);
        $tblMess->addColumn('id', 'integer', [
            'autoIncrement' => true,
            'default' => null,
            'limit' => 11,
            'null' => false,
        ])
            ->addPrimaryKey(['id'])
            ->addColumn('from_id', 'integer')
            ->addColumn('to_id', 'integer')
            ->addColumn('talk_id', 'integer')
            ->addColumn('body', 'text')
            ->addColumn('is_new', 'string', array('limit' => 1,'default'=>'y'))
            ->addColumn('from_user_info', 'text')
            ->addColumn('to_user_info', 'text')
            ->addColumn('created', 'datetime',['default'=> "CURRENT_TIMESTAMP"])
            ->addColumn('modified', 'datetime', array('null' => true,'default'=>null))
            ->save();

    }
    public function down()
    {
        $this->table('tbl_master_message')->drop();
    }
}
