<?php
use Migrations\AbstractSeed;

/**
 * TblMasterCategories seed.
 */
class TblMasterCategoriesSeed extends AbstractSeed
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
        $data = [[
            'id'    => 1,
            'name'  => 'test',
            'created'  => '2016-08-27 13:23:29',
            'modified'  => '2016-08-27 13:23:29',
        ],
            [
                'id'    => 5,
                'name'  => 'test2',
                'created'  => '2016-08-27 13:23:29',
                'modified'  => '2016-08-27 13:23:29',
            ],
        ];

        $table = $this->table('tbl_master_categories');
        $table->insert($data)->save();
    }
}
