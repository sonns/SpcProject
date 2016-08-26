<?php
use App\Utility\FunctionCommon;
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
        $common = new FunctionCommon();

        $pass  = $common->cipher_encrypt('123456',MCRYPT_KEY);

        $data = [
            [
                'id'    => 1,
                'dep_id'    => 1,
                'password'  => $pass,
                'first_name'  => 'Son',
                'last_name'  => 'Nguyen',
                'full_name'  => 'Nguyen Truong Son',
                'email'  => 'truongsonns@gmail.com',
                'username'  => 'sonns',
                'tel'  => '0932647746',
                'employee_level'  => 'develop',
                'del_flg'  => 0,
                'created'  => '2016-08-27 13:23:29',
                'modified'  => '2016-08-27 13:23:29',
            ],
            [
                'id'    => 2,
                'dep_id'    => 1,
                'password'  => $pass,
                'first_name'  => 'Son',
                'last_name'  => 'Nguyen',
                'full_name'  => 'Nguyen Truong Son',
                'email'  => 'truongsonns1@gmail.com',
                'username'  => 'sonns1',
                'tel'  => '0932647746',
                'employee_level'  => 'develop',
                'del_flg'  => 0,
                'created'  => '2016-08-27 13:23:29',
                'modified'  => '2016-08-27 13:23:29',
            ]
        ];

        $table = $this->table('tbl_master_users');
        $table->insert($data)->save();
    }
}
