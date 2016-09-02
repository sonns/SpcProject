<?php
use Migrations\AbstractMigration;

class TblMasterRules extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-change-method
     * @return void */
    public function up()
    {
        $requests = $this->table('tbl_master_rules', [
            'id' => false,
            'primary_key' => ['id']
        ]);
        $requests->addColumn('id', 'integer', [
            'autoIncrement' => true,
            'default' => null,
            'limit' => 11,
            'null' => false,
        ])
            ->addPrimaryKey(['id'])
            ->addColumn('dep_id', 'integer')
            ->addColumn('key', 'string')
            ->addColumn('value', 'string')
            ->addColumn('comparision_operator', 'string', array('limit' => 2,'default'=>1))
            ->addColumn('action', 'string')
            ->addColumn('is_active', 'integer', array('limit' => 1,'default'=>1))
            ->addColumn('created', 'datetime',['default'=> "CURRENT_TIMESTAMP"])
            ->addColumn('modified', 'datetime', array('null' => true,'default'=>null))
            ->addForeignKey(
                'dep_id',
                'tbl_master_departments',
                'id',
                [
                    'update' => 'CASCADE',
                    'delete' => 'CASCADE'
                ]
            )
            ->addIndex(
                [
                    'dep_id',
                ]
            )
            ->addIndex(
                [
                    'key',
                ]
            )
            ->addIndex(
                [
                    'value',
                ]
            )

            ->save();
    }
    public function down()
    {
        $this->table('tbl_master_rules')->dropForeignKey(['dep_id']);
        $this->table('tbl_master_rules')->drop();
    }
}