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
            ->addColumn('first_name', 'string', array('limit' => 50,'null' => true))
            ->addColumn('last_name', 'string', array('limit' => 50,'null' => true))
            ->addColumn('email', 'string')
            ->addColumn('username', 'string')
            ->addColumn('password', 'blob', array('limit' => MysqlAdapter::BLOB_REGULAR))
            ->addColumn('remember_token', 'string', array('limit' => 255,'null' => true,'default'=>null))
            ->addColumn('confirmation_code', 'string', array('limit' => 200,'null' => true,'default'=>null))
            ->addColumn('confirmed', 'integer', array('limit' => 50,'null' => true,'default'=>0))
            ->addColumn('provider', 'string', array('limit' => 100,'null' => true,'default'=>null))
            ->addColumn('last_login', 'datetime', array('limit' => 50,'null' => true,'default'=>null))
            ->addColumn('last_login_ip', 'string', array('limit' => 100,'null' => true,'default'=>null))
            ->addColumn('last_login_now', 'datetime', array('limit' => 50,'null' => true,'default'=>null))
            ->addColumn('last_login_ip_now', 'string', array('limit' => 100,'null' => true,'default'=>null))
//            ->addColumn('employee_level','enum', array('values' => ['top', 'manager','sub_manager','normal','develop'],'default' => 'normal'))
            ->addColumn('del_flg', 'integer' , ['limit'=>1,'default'=>0])
            ->addColumn('created', 'datetime',['default'=> "CURRENT_TIMESTAMP"])
            ->addColumn('modified', 'datetime', array('null' => true,'default'=>null))
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
        $this->table('tbl_master_approval')->dropForeignKey(['user_id']);
        $this->table('tbl_master_profile')->dropForeignKey(['user_id']);
        $this->table('tbl_master_requests')->dropForeignKey(['user_id']);
        $this->table('tbl_master_users')->drop();
    }
}
