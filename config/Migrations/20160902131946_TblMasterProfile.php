<?php
use Migrations\AbstractMigration;

class TblMasterProfile extends AbstractMigration
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
        $profile = $this->table('tbl_master_profile', [
            'id' => false,
            'primary_key' => ['id']
        ]);
        $profile->addColumn('id', 'integer', [
            'autoIncrement' => true,
            'default' => null,
            'limit' => 11,
            'null' => false,
        ]) ->addPrimaryKey(['id'])
            ->addColumn('user_id', 'integer')
            ->addColumn('photo', 'string', array('limit' => 255,'null' => true,'default'=>null))
            ->addColumn('contact_number', 'string', array('limit' => 100,'null' => true,'default'=>null))
            ->addColumn('alternate_contact_number', 'string', array('limit' => 100,'null' => true,'default'=>null))
            ->addColumn('alternate_email', 'string',['limit' => 100,'null'=>true,'default'=>null])
            ->addColumn('timezone', 'string',['null'=> true,'default'=> null])
            ->addColumn('birthday', 'datetime',['null'=> true,'default'=> null])
            ->addColumn('address', 'text', ['null'=> true,'default'=>null])
            ->addColumn('created', 'datetime',['default'=> "CURRENT_TIMESTAMP"])
            ->addColumn('modified', 'datetime', array('null' => true,'default'=>null))
            ->addForeignKey( 'user_id',
                'tbl_master_users',
                'id',
                [
                    'update' => 'CASCADE',
                    'delete' => 'CASCADE'
                ])
            ->save();

    }
    public function down()
    {
        $this->table('tbl_master_profile')->drop();
        parent::down(); // TODO: Change the autogenerated stub
    }
}