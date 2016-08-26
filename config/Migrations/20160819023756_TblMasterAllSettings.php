<?php
use Migrations\AbstractMigration;

class TblMasterAllSettings extends AbstractMigration
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
        $exists = $this->hasTable('tbl_master_all_settings');
        if (!$exists) {
            $users = $this->table('tbl_master_all_settings');
            $users->addColumn('skey', 'enum', array('values' => ['title']))
                ->addColumn('svalue', 'text')
                ->addColumn('del_flg', 'integer',['limit'=>1])
                ->addColumn('created', 'datetime')
                ->addColumn('updated', 'datetime', array('null' => true))
                ->addPrimaryKey('id', [
                    'autoIncrement' => true
                ])
                ->save();

        }else{



        }
    }
    public function down()
    {
        $this->dropTable('tbl_master_all_settings');
    }
}
