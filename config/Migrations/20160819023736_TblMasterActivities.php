<?php
use Migrations\AbstractMigration;

class TblMasterActivities extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-change-method
     * @return void
     */

    public function up(){
        $tblActi = $this->table('tbl_master_activities', [
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
            ->addColumn('title', 'string')
            ->addColumn('contents', 'text')
            ->addColumn('start_time', 'date')
            ->addColumn('end_time', 'date')
            ->addColumn('del_flg', 'integer', array('limit' => 1))
            ->addColumn('created', 'datetime')
            ->addColumn('modified', 'datetime')
            ->save();

    }
    public function down()
    {
        $this->table('tbl_master_activities')->drop();
    }
}
