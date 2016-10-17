<?php
use Migrations\AbstractSeed;

/**
 * TblMasterAllSettings seed.
 */
class TblMasterAllSettingsSeed extends AbstractSeed
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
        $data = [];

        $table = $this->table('tbl_master_all_settings');
        if(!empty($data))
            $table->insert($data)->save();
    }
}
