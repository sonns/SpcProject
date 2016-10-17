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
                'name'  => 'admin',
                'display_name'  => 'Admin',
                'created'  => '2016-08-27 13:23:29',
                'modified'  => '2016-08-27 13:23:29',
            ],
            [
                'id'    => 2,
                'name'  => 'top',
                'display_name'  => 'Top',
                'created'  => '2016-08-27 13:23:29',
                'modified'  => '2016-08-27 13:23:29',
            ],
            [
                'id'    => 3,
                'name'  => 'manager',
                'display_name'  => 'Manager',
                'created'  => '2016-08-27 13:23:29',
                'modified'  => '2016-08-27 13:23:29',
            ],
            [
                'id'    => 4,
                'name'  => 'sub-manager',
                'display_name'  => 'Sub-Manger',
                'created'  => '2016-08-27 13:23:29',
                'modified'  => '2016-08-27 13:23:29',
            ],
            [
                'id'    => 5,
                'name'  => 'staff',
                'display_name'  => 'Staff',
                'created'  => '2016-08-27 13:23:29',
                'modified'  => '2016-08-27 13:23:29',
            ]
        ];
//
        $table = $this->table('tbl_master_roles');
        $table->insert($data)->save();

        $data = [
            [
                'id'    => 1,
                'user_id'    => 1,
                'role_id'  => 1,
            ],
            [
                'id'    => 2,
                'user_id'    => 2,
                'role_id'  => 2,
            ],
            [
                'id'    => 3,
                'user_id'    => 3,
                'role_id'  => 3,
            ],
            [
                'id'    => 4,
                'user_id'    => 4,
                'role_id'  => 5,
            ],
            [
                'id'    => 5,
                'user_id'    => 5,
                'role_id'  => 3,
            ],
            [
                'id'    => 6,
                'user_id'    => 6,
                'role_id'  => 4,
            ],
            [
                'id'    => 7,
                'user_id'    => 7,
                'role_id'  => 5,
            ],
            [
                'id'    => 8,
                'user_id'    => 8,
                'role_id'  => 3,
            ],
            [
                'id'    => 9,
                'user_id'    => 9,
                'role_id'  => 4,
            ],
            [
                'id'    => 10,
                'user_id'    => 10,
                'role_id'  => 5,
            ]
        ];

        $table = $this->table('tbl_master_role_user');
        $table->insert($data)->save();
    }
}
