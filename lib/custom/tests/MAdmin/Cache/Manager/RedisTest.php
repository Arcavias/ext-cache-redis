<?php

/**
 * @copyright Copyright (c) Metaways Infosystems GmbH, 2014
 * @license LGPLv3, http://www.arcavias.com/en/license
 */

class MAdmin_Cache_Manager_RedisTest extends MW_Unittest_Testcase
{
	private $_object;


	/**
	 * Sets up the fixture, for example, opens a network connection.
	 * This method is called before a test is executed.
	 *
	 * @access protected
	 */
	protected function setUp()
	{
		$this->_context = TestHelper::getContext();
		$this->_object = new MAdmin_Cache_Manager_Redis( $this->_context );
	}


	/**
	 * Tears down the fixture, for example, closes a network connection.
	 * This method is called after a test is executed.
	 *
	 * @access protected
	 */
	protected function tearDown()
	{
		$this->_object = null;
	}


	public function testCleanup()
	{
		$this->_object->cleanup( array( -1 ) );
	}


	public function testCreateItem()
	{
		$this->assertInstanceOf( 'MAdmin_Cache_Item_Interface', $this->_object->createItem() );
	}


	public function testGetSearchAttributes()
	{
		foreach( $this->_object->getSearchAttributes() as $attr ) {
			$this->assertInstanceOf('MW_Common_Criteria_Attribute_Interface', $attr );
		}
	}


	public function testGetSubManager()
	{
		$this->setExpectedException('MAdmin_Exception');
		$this->_object->getSubManager( 'unknown' );
	}


	public function testSearchItems()
	{
		$search = $this->_object->createSearch();
		$search->setConditions( $search->compare( '==', 'cache.id', 'unittest' ) );

		$this->assertEquals( array(), $this->_object->searchItems( $search ) );
	}


	public function testGetItem()
	{
		$this->markTestIncomplete();
	}


	public function testSaveUpdateDeleteItem()
	{
		$this->markTestIncomplete();
	}
}
