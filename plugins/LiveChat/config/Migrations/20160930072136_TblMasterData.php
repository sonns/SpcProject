<?php
use Migrations\AbstractMigration;

class TblMasterData extends AbstractMigration
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
        $tblMess = $this->table('tbl_master_data', [
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
            ->addColumn('type', 'string')
            ->addColumn('key', 'string')
            ->addColumn('value', 'string')
            ->addColumn('created', 'datetime',['default'=> "CURRENT_TIMESTAMP"])
            ->addColumn('modified', 'datetime', array('null' => true,'default'=>null))
            ->save();

    }
    public function down()
    {
        $this->table('tbl_master_data')->drop();
    }
}
