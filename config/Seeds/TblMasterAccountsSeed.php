<?php
use App\Utility\FunctionCommon;
use Migrations\AbstractSeed;
/**
 * TblMasterAccounts seed.
 */
class TblMasterAccountsSeed extends AbstractSeed
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

        $data = [];
        $pass  = $common->cipher_encrypt('123455',MCRYPT_KEY);
        $table = $this->table('tbl_master_accounts');
        $rows = [
            [
                'id'    => 1,
                'login_id'  => 'hayahide',
                'login_pass'  => $pass,
                'del_flg'  => 0,
                'created'  => '2016-07-27 13:23:29',
                'modified'  => '2016-07-27 13:23:29',
            ],
            [
                'id'    => 2,
                'login_id'  => 'kiyosawa',
                'login_pass'  => $pass,
                'del_flg'  => 0,
                'created'  => '2016-07-27 13:23:29',
                'modified'  => '2016-07-27 13:23:29',
            ]
        ];
        $table->insert($rows)->save();
    }
}
