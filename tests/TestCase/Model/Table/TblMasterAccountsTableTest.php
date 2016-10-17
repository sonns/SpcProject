<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TblMasterAccountsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TblMasterAccountsTable Test Case
 */
class TblMasterAccountsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\TblMasterAccountsTable
     */
    public $TblMasterAccounts;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.tbl_master_accounts',
        'app.logins'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('TblMasterAccounts') ? [] : ['className' => 'App\Model\Table\TblMasterAccountsTable'];
        $this->TblMasterAccounts = TableRegistry::get('TblMasterAccounts', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->TblMasterAccounts);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
