<?php
App::uses('BooksWriter', 'Model');

/**
 * BooksWriter Test Case
 */
class BooksWriterTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.books_writer',
		'app.book',
		'app.category',
		'app.comment',
		'app.writer'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->BooksWriter = ClassRegistry::init('BooksWriter');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->BooksWriter);

		parent::tearDown();
	}

}
