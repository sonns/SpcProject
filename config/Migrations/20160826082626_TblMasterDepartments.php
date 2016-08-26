<?php
use Migrations\AbstractMigration;

class TblMasterDepartments extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-change-method
     * @return void
     */
    public function change()
    {
        $departments = $this->table('tbl_master_departments');
        $departments->addColumn('id', 'integer', [
                'autoIncrement' => true,
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addPrimaryKey(['id'])
            ->addColumn('name', 'text')
            ->addColumn('tel', 'string',['null'=>true])
            ->addColumn('address', 'string',['null'=>true])
            ->addColumn('del_flg', 'integer', array('limit' => 1,'default'=>0))
            ->addColumn('created', 'datetime')
            ->addColumn('modified', 'datetime')
            ->addIndex(
                [
                    'name',
                ]
            )
            ->save();
    }
}
