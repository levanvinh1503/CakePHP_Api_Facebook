<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PostSocialTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PostSocialTable Test Case
 */
class PostSocialTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\PostSocialTable
     */
    public $PostSocial;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.post_social'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('PostSocial') ? [] : ['className' => PostSocialTable::class];
        $this->PostSocial = TableRegistry::getTableLocator()->get('PostSocial', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->PostSocial);

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
