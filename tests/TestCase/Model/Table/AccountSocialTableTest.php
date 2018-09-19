<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\AccountSocialTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\AccountSocialTable Test Case
 */
class AccountSocialTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\AccountSocialTable
     */
    public $AccountSocial;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.account_social'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('AccountSocial') ? [] : ['className' => AccountSocialTable::class];
        $this->AccountSocial = TableRegistry::getTableLocator()->get('AccountSocial', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->AccountSocial);

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
}
