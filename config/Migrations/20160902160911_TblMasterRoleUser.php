<?php
use Migrations\AbstractMigration;

class TblMasterRoleUser extends AbstractMigration
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
        $roles = $this->table('tbl_master_role_user', [
            'id' => false,
            'primary_key' => ['id']
        ]);
        $roles->addColumn('id', 'integer', [
            'autoIncrement' => true,
            'default' => null,
            'limit' => 11,
            'null' => false,
        ]) ->addPrimaryKey(['id'])
            ->addColumn('user_id', 'integer')
            ->addColumn('role_id', 'integer')
            ->addForeignKey( 'user_id',
                'tbl_master_users',
                'id',
                [
                    'update' => 'CASCADE',
                    'delete' => 'CASCADE'
                ])
            ->addForeignKey( 'role_id',
                'tbl_master_roles',
                'id',
                [
                    'update' => 'CASCADE',
                    'delete' => 'CASCADE'
                ])

            ->save();
    }
    public function down()
    {
        $this->table('tbl_master_role_user')->drop();
        parent::down(); // TODO: Change the autogenerated stub
    }
}
