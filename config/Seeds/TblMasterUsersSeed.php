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
        $data = [
            [
                'id'    => 1,
                'name'  => 'Admin',
                'display_name'  => 'Admin',
                'created'  => '2016-08-27 13:23:29',
                'modified'  => '2016-08-27 13:23:29',
            ],
            [
                'id'    => 2,
                'name'  => 'Top',
                'display_name'  => 'Top',
                'created'  => '2016-08-27 13:23:29',
                'modified'  => '2016-08-27 13:23:29',
            ],
            [
                'id'    => 3,
                'name'  => 'Manager',
                'display_name'  => 'Manager',
                'created'  => '2016-08-27 13:23:29',
                'modified'  => '2016-08-27 13:23:29',
            ],
            [
                'id'    => 4,
                'name'  => 'Sub-manager',
                'display_name'  => 'Nguyen',
                'created'  => '2016-08-27 13:23:29',
                'modified'  => '2016-08-27 13:23:29',
            ],
            [
                'id'    => 5,
                'name'  => 'Staff',
                'display_name'  => 'Staff',
                'created'  => '2016-08-27 13:23:29',
                'modified'  => '2016-08-27 13:23:29',
            ]
        ];
//
        $table = $this->table('tbl_master_roles');
        $table->insert($data)->save();

        $common = new FunctionCommon();

        $pass  = $common->cipher_encrypt('123456',MCRYPT_KEY);

        $data = [
            [
                'id'    => 1,
                'dep_id'    => 1,
                'password'  => $pass,
                'first_name'  => 'Son',
                'last_name'  => 'Nguyen',
                'email'  => 'truongsonns@gmail.com',
                'username'  => 'sonns',
                'confirmed'=>1,
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
                'email'  => 'truongsonns1@gmail.com',
                'username'  => 'sonns1',
                'confirmed'=>0,
                'del_flg'  => 0,
                'created'  => '2016-08-27 13:23:29',
                'modified'  => '2016-08-27 13:23:29',
            ]
        ];

        $table = $this->table('tbl_master_users');
        $table->insert($data)->save();



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
