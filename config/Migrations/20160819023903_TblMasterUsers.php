<?php
use Migrations\AbstractMigration;
use Phinx\Db\Adapter\MysqlAdapter;

class TblMasterUsers extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-change-method
     * @return void
     */

    public function up(){
        $users = $this->table('tbl_master_users', [
            'id' => false,
            'primary_key' => ['id']
        ]);
        $users->addColumn('id', 'integer', [
            'autoIncrement' => true,
            'default' => null,
            'limit' => 11,
            'null' => false,
        ])
            ->addPrimaryKey(['id'])
            ->addColumn('dep_id', 'integer')
            ->addColumn('first_name', 'string', array('limit' => 20))
            ->addColumn('last_name', 'string', array('limit' => 20))
            ->addColumn('full_name', 'string', array('limit' => 100))
            ->addColumn('email', 'string')
            ->addColumn('username', 'string')
            ->addColumn('password', 'blob', array('limit' => MysqlAdapter::BLOB_REGULAR))
            ->addColumn('tel', 'string', array('limit' => 50))
            ->addColumn('employee_level','enum', array('values' => ['top', 'manager','sub_manager','normal','develop'],'default' => 'normal'))
            ->addColumn('del_flg', 'integer' , ['limit'=>1])
            ->addColumn('created', 'datetime')
            ->addColumn('modified', 'datetime', array('null' => true))
            ->addIndex(array('email','username'), array('unique' => true))
            ->addIndex(
                [
                    'dep_id',
                ]
            )
            ->addIndex(
                [
                    'email',
                ]
            )
            ->addIndex(
                [
                    'full_name',
                ]
            )
            ->save();
    }
    public function down()
    {
        $this->table('tbl_master_users')->drop();
    }
}
