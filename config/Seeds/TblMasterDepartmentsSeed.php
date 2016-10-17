<?php
use Migrations\AbstractSeed;

/**
 * TblMasterDepartments seed.
 */
class TblMasterDepartmentsSeed extends AbstractSeed
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
                'name'  => 'Developer',
                'tel'  => '0932647746',
                'address'  => 'Viet Nam',
                'del_flg'  => 0,
                'created'  => '2016-08-27 13:23:29',
                'modified'  => '2016-08-27 13:23:29',
            ],
            [
                'id'    => 2,
                'name'  => 'Headquarter',
                'tel'  => '0932093940',
                'address'  => 'Tokyo',
                'del_flg'  => 0,
                'created'  => '2016-08-27 13:23:29',
                'modified'  => '2016-08-27 13:23:29',
            ],
            [
                'id'    => 3,
                'name'  => 'Branch(Viet Nam)',
                'tel'  => '0932093940',
                'address'  => 'Viet Nam',
                'del_flg'  => 0,
                'created'  => '2016-08-27 13:23:29',
                'modified'  => '2016-08-27 13:23:29',
            ]
            ,
            [
                'id'    => 4,
                'name'  => 'Branch(Lao)',
                'tel'  => '0932093940',
                'address'  => 'Lao',
                'del_flg'  => 0,
                'created'  => '2016-08-27 13:23:29',
                'modified'  => '2016-08-27 13:23:29',
            ]
        ];

        $table = $this->table('tbl_master_departments');
        $table->insert($data)->save();
    }
}
