<?php
use Migrations\AbstractSeed;

/**
 * TblMasterUsers seed.
 */
class TblMasterUsersSeed extends AbstractSeed
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
                'hash'  => 'hayahide4561',
                'first_name'  => 清沢,
                'second_name'  => 直樹,
                'email'  => 'hayahide4561@gmail.com',
                'tel'  => '090-2222-4431',
                'employee_level'  => 'master',
                'del_flg'  => 0,
                'created'  => '2016-07-27 13:23:29',
                'modified'  => '2016-07-27 13:23:29',
            ],
            [
                'id'    => 2,
                'hash'  => 'f52122c4e0bec5a8dabcf5b4e35b1e55',
                'first_name'  => 'Sample',
                'second_name'  => 'Tarou',
                'email'  => 'hayahide45611@gmail.com',
                'tel'  => '090-3333-4444',
                'employee_level'  => 'normal',
                'del_flg'  => 1,
                'created'  => '2016-07-27 13:23:29',
                'modified'  => '2016-07-27 13:23:29',
            ]
        ];

        $table = $this->table('tbl_master_users');
        $table->insert($data)->save();
    }
}
