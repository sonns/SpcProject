<?php
use App\Utility\FunctionCommon;
use Migrations\AbstractSeed;

/**
 * TblMasterRequests seed.
 */
class TblMasterRequestsSeed extends AbstractSeed
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
                'email'  => 'truongsonns@gmail.com',
                'username'  => 'sonns',
                'confirmed'=>1,
                'del_flg'  => 0,
                'created'  => '2016-08-27 13:23:29',
                'modified'  => '2016-08-27 13:23:29',
            ],
            [
                'id'    => 2,
                'dep_id'    => 2,
                'password'  => $pass,
                'email'  => 'truongsonns1@gmail.com',
                'username'  => 'sonns1',
                'confirmed'=>1,
                'del_flg'  => 0,
                'created'  => '2016-08-27 13:23:29',
                'modified'  => '2016-08-27 13:23:29',
            ],
            [
                'id'    => 3,
                'dep_id'    => 2,
                'password'  => $pass,
                'email'  => 'truongsonns2@gmail.com',
                'username'  => 'sonns2',
                'confirmed'=>1,
                'del_flg'  => 0,
                'created'  => '2016-08-27 13:23:29',
                'modified'  => '2016-08-27 13:23:29',
            ],
            [
                'id'    => 4,
                'dep_id'    => 2,
                'password'  => $pass,
                'email'  => 'truongsonns3@gmail.com',
                'username'  => 'sonns3',
                'confirmed'=>1,
                'del_flg'  => 0,
                'created'  => '2016-08-27 13:23:29',
                'modified'  => '2016-08-27 13:23:29',
            ],
            [
                'id'    => 5,
                'dep_id'    => 3,
                'password'  => $pass,
                'email'  => 'truongsonns4@gmail.com',
                'username'  => 'sonns4',
                'confirmed'=>1,
                'del_flg'  => 0,
                'created'  => '2016-08-27 13:23:29',
                'modified'  => '2016-08-27 13:23:29',
            ],
            [
                'id'    => 6,
                'dep_id'    => 3,
                'password'  => $pass,
                'email'  => 'truongsonns5@gmail.com',
                'username'  => 'sonns5',
                'confirmed'=>1,
                'del_flg'  => 0,
                'created'  => '2016-08-27 13:23:29',
                'modified'  => '2016-08-27 13:23:29',
            ],
            [
                'id'    => 7,
                'dep_id'    => 3,
                'password'  => $pass,
                'email'  => 'truongsonns6@gmail.com',
                'username'  => 'sonns6',
                'confirmed'=>1,
                'del_flg'  => 0,
                'created'  => '2016-08-27 13:23:29',
                'modified'  => '2016-08-27 13:23:29',
            ],
            [
                'id'    => 8,
                'dep_id'    => 4,
                'password'  => $pass,
                'email'  => 'truongsonns7@gmail.com',
                'username'  => 'sonns7',
                'confirmed'=>1,
                'del_flg'  => 0,
                'created'  => '2016-08-27 13:23:29',
                'modified'  => '2016-08-27 13:23:29',
            ],
            [
                'id'    => 9,
                'dep_id'    => 4,
                'password'  => $pass,
                'email'  => 'truongsonns8@gmail.com',
                'username'  => 'sonns8',
                'confirmed'=>1,
                'del_flg'  => 0,
                'created'  => '2016-08-27 13:23:29',
                'modified'  => '2016-08-27 13:23:29',
            ],
            [
                'id'    => 10,
                'dep_id'    => 4,
                'password'  => $pass,
                'email'  => 'truongsonns9@gmail.com',
                'username'  => 'sonns9',
                'confirmed'=>1,
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
                'user_id'  => 1,
                'dep_id'  => 1,
                'cate_id'  => 1,
                'title'  => 'Request Computer',
                'reason'  => 'Request Computer',
                'price'  => 3000,
                'description'  => 'test',
                'effectiveness'  => 'test',
                'note'  => 'test',
                'appr_date'  => '2016-10-27 13:23:29',
                'status'  => 1,
                'created'  => '2016-08-27 13:23:29',
                'modified'  => '2016-08-27 13:23:29',
            ],
            [
                'id'    => 2,
                'user_id'  => 1,
                'dep_id'  => 1,
                'cate_id'  => 1,
                'title'  => 'Request Computer',
                'reason'  => 'Request Computer',
                'price'  => 3000,
                'description'  => 'test',
                'effectiveness'  => 'test',
                'note'  => 'test',
                'appr_date'  => '2016-10-27 13:23:29',
                'status'  => 1,
                'created'  => '2016-08-27 13:23:29',
                'modified'  => '2016-08-27 13:23:29',
            ],
            [
                'id'    => 3,
                'user_id'  => 1,
                'dep_id'  => 1,
                'cate_id'  => 1,
                'title'  => 'Request Computer',
                'reason'  => 'Request Computer',
                'price'  => 3000,
                'description'  => 'test',
                'effectiveness'  => 'test',
                'note'  => 'test',
                'appr_date'  => '2016-10-27 13:23:29',
                'status'  => 1,
                'created'  => '2016-08-27 13:23:29',
                'modified'  => '2016-08-27 13:23:29',
            ],
            [
                'id'    => 4,
                'user_id'  => 1,
                'dep_id'  => 1,
                'cate_id'  => 1,
                'title'  => 'Request Computer',
                'reason'  => 'Request Computer',
                'price'  => 3000,
                'description'  => 'test',
                'effectiveness'  => 'test',
                'note'  => 'test',
                'appr_date'  => '2016-10-27 13:23:29',
                'status'  => 1,
                'created'  => '2016-08-27 13:23:29',
                'modified'  => '2016-08-27 13:23:29',
            ],
            [
                'id'    => 5,
                'user_id'  => 1,
                'dep_id'  => 1,
                'cate_id'  => 1,
                'title'  => 'Request Computer',
                'reason'  => 'Request Computer',
                'price'  => 3000,
                'description'  => 'test',
                'effectiveness'  => 'test',
                'note'  => 'test',
                'appr_date'  => '2016-10-27 13:23:29',
                'status'  => 1,
                'created'  => '2016-08-27 13:23:29',
                'modified'  => '2016-08-27 13:23:29',
            ],

        ];
//
        $table = $this->table('tbl_master_requests');
        $table->insert($data)->save();

    }
}
