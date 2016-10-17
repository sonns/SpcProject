<?php
namespace App\Test\TestCase\Controller\Component;

use App\Controller\Component\FunctionUntilComponent;
use Cake\Controller\ComponentRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Controller\Component\FunctionUntilComponent Test Case
 */
class FunctionUntilComponentTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Controller\Component\FunctionUntilComponent
     */
    public $FunctionUntil;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $registry = new ComponentRegistry();
        $this->FunctionUntil = new FunctionUntilComponent($registry);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->FunctionUntil);

        parent::tearDown();
    }

    /**
     * Test initial setup
     *
     * @return void
     */
    public function testInitialization()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
