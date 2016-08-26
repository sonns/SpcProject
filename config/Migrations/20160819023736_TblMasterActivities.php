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
    public function up()
    {
        $exists = $this->hasTable('tbl_master_activities');
        if (!$exists) {
            $users = $this->table('tbl_master_activities');
            $users->addColumn('title', 'string')
                ->addColumn('contents', 'text')
                ->addColumn('start_time', 'date')
                ->addColumn('end_time', 'date')
                ->addColumn('del_flg', 'integer', array('limit' => 1))
                ->addColumn('created', 'datetime')
                ->addColumn('modified', 'datetime')
                ->addPrimaryKey('id', [
                    'autoIncrement' => true
                ])
                ->save();

        }else{

        }
    }
    public function down()
    {
        $this->dropTable('tbl_master_activities');
    }
}
