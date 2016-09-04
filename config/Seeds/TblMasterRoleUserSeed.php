<?php
use Migrations\AbstractSeed;

/**
 * TblMasterRoleUser seed.
 */
class TblMasterRoleUserSeed extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeders is available here:
     * http://docs.phinx.org/en/latest/seeding.html
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'id'    => 1,
                'user_id'    => 1,
                'role_id'  => 1,
            ]
        ];

        $table = $this->table('tbl_master_role_user');
        $table->insert($data)->save();
    }
}
