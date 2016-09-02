<?php
use Migrations\AbstractMigration;

class TblMasterMenu extends AbstractMigration
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
        $departments = $this->table('tbl_master_menu', [
            'id' => false,
            'primary_key' => ['id']
        ]);
        $departments->addColumn('id', 'integer', [
            'autoIncrement' => true,
            'default' => null,
            'limit' => 11,
            'null' => false,
        ])
            ->addPrimaryKey(['id'])
            ->addColumn('parent_id', 'string')
            ->addColumn('title', 'string')
            ->addColumn('link', 'integer')
            ->addColumn('index', 'integer', array('null'=>true,'default'=>0))
            ->addColumn('icon', 'string', array('null'=>true))
            ->addColumn('active', 'integer', array('limit' => 1,'default'=>0))
            ->addColumn('del_flg', 'integer', array('limit' => 1,'default'=>0))
            ->addColumn('created', 'datetime',['default'=> "CURRENT_TIMESTAMP"])
            ->addColumn('modified', 'datetime', array('null' => true,'default'=>null))
            ->addIndex(
                [
                    'title',
                ]
            )->addIndex(
                [
                    'parent_id',
                ]
            )
            ->save();
    }
    public function down()
    {
        $this->table('tbl_master_requests')->dropForeignKey(['cate_id']);
        $this->table('tbl_master_categories')->drop();
    }
}
