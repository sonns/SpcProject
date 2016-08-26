<?php
use Migrations\AbstractMigration;

class TblMasterRequests extends AbstractMigration
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
        $requests = $this->table('tbl_master_departments');
        $requests->addColumn('id', 'integer')
            ->addColumn('user_id', 'integer')
            ->addColumn('dep_id', 'integer')
            ->addColumn('subject', 'string')
            ->addColumn('description', 'text',['null'=>true])
            ->addColumn('effectiveness', 'text',['null'=>true])
            ->addColumn('attach', 'text')
            ->addColumn('note', 'text')
            ->addColumn('appr_date', 'datetime')
            ->addColumn('del_flg', 'integer', array('limit' => 1,'default'=>0))
            ->addColumn('created', 'datetime')
            ->addColumn('modified', 'datetime')
            ->addPrimaryKey('id', [
                'autoIncrement' => true
            ])
            ->save();
    }
}
