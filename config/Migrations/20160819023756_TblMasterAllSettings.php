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

    public function up(){
        $tblSetting = $this->table('tbl_master_all_settings', [
            'id' => false,
            'primary_key' => ['id']
        ]);
        $tblSetting->addColumn('id', 'integer', [
            'autoIncrement' => true,
            'default' => null,
            'limit' => 11,
            'null' => false,
        ])
            ->addPrimaryKey(['id'])
            ->addColumn('skey', 'enum', array('values' => ['title']))
            ->addColumn('svalue', 'text')
            ->addColumn('del_flg', 'integer',['limit'=>1])
            ->addColumn('created', 'datetime')
            ->addColumn('modified', 'datetime', array('null' => true))
            ->save();
    }
    public function down()
    {
        $this->table('tbl_master_all_settings')->drop();
    }
}
