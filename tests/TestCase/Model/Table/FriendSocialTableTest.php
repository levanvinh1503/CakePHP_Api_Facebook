<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\FriendSocialTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\FriendSocialTable Test Case
 */
class FriendSocialTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\FriendSocialTable
     */
    public $FriendSocial;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.friend_social'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('FriendSocial') ? [] : ['className' => FriendSocialTable::class];
        $this->FriendSocial = TableRegistry::getTableLocator()->get('FriendSocial', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->FriendSocial);

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
