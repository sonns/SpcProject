<?php
use Migrations\AbstractSeed;

/**
 * TblMasterMenu seed.
 */
class TblMasterMenuSeed extends AbstractSeed
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
                'parent_id'    => 0,
                'title'  => 'Dashboard',
                'link'  => '/',
                'index'  => 0,
                'icon'  => "",
                'active'  => 1,
            ],
            [
                'id'    => 2,
                'parent_id'    => 0,
                'title'  => 'Users',
                'link'  => '/user/list',
                'index'  => 1,
                'icon'  => "",
                'active'  => 1,
            ],[
                'id'    => 3,
                'parent_id'    => 0,
                'title'  => 'Departments',
                'link'  => '/department',
                'index'  => 2,
                'icon'  => "",
                'active'  => 1,
            ],[
                'id'    => 4,
                'parent_id'    => 0,
                'title'  => 'Configuration',
                'link'  => '/configuration',
                'index'  => 3,
                'icon'  => "",
                'active'  => 1,
            ]
        ];

        $table = $this->table('tbl_master_menu');
        $table->insert($data)->save();
    }
}
