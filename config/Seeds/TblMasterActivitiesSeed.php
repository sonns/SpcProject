<?php
use Migrations\AbstractSeed;

/**
 * TblMasterActivities seed.
 */
class TblMasterActivitiesSeed extends AbstractSeed
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
                'title'  => 'aaa',
                'contents'  => 'bbb',
                'start_time'  => '2016-07-29',
                'end_time'  => '2016-07-29',
                'del_flg'  => 0,
                'created'  => '2016-07-27 13:23:29',
                'modified'  => '2016-07-27 13:23:29',
            ]
        ];

        $table = $this->table('tbl_master_activities');
        $table->insert($data)->save();
    }
}
