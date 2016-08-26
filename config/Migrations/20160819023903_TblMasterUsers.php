<?php
use Migrations\AbstractMigration;

class TblMasterUsers extends AbstractMigration
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
        $exists = $this->hasTable('tbl_master_users');
        if (!$exists) {
            $users = $this->table('tbl_master_users');
            $users->addColumn('hash', 'string', array('limit' => 50))
                ->addColumn('first_name', 'string', array('limit' => 20))
                ->addColumn('last_name', 'string', array('limit' => 20))
                ->addColumn('full_name', 'string', array('limit' => 100))
                ->addColumn('email', 'string')
                ->addColumn('tel', 'string', array('limit' => 50))
                ->addColumn('employee_level','enum', array('values' => ['top', 'manager','sub_manager','normal','develop'],'default' => 'normal'))
                ->addColumn('del_flg', 'integer' , ['limit'=>1])
                ->addColumn('created', 'datetime')
                ->addColumn('modified', 'datetime', array('null' => true))
                ->addIndex(array('email'), array('unique' => true))
                ->addPrimaryKey('id', [
                    'autoIncrement' => true
                ])
                ->save();

        }else{


        }
    }
    public function down()
    {
        $this->dropTable('tbl_master_users');
    }
}
