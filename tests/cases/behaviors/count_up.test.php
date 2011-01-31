<?php
/*
 * Count Plugin for CakePHP
 * 
 * PHP version 5
 *
 * @copyright Copyright 2010, Cake. (http://trpgtools-onweb.sourceforge.jp/)
 * @category BehavoirTest
 * @package  Count Plugin
 * @version  0.1
 * @author   Cake <cake_67@users.sourceforge.jp>
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link     https://github.com/Cake/CakePHP-Counter-Plugin
 */

App::import('Behavior', 'Count.CountUp');

class Count extends CakeTestModel {
	public $useTable = 'counts';

	public $belongsTo = array();
	public $hasAndBelongsToMany = array();
	public $hasMany = array();
	public $hasOne = array();

	public $actsAs = array('Count.CountUp');
}

class CountUpTestCase extends CakeTestCase {
	public $plugin = 'count';
	public $Count = null;

	var $fixtures = array('plugin.count.count');

/**
 * Method executed before each test
 *
 * @return void
 */
	public function startTest() {
		$this->Count = ClassRegistry::init('Count');
		$this->Count->Behaviors->attach('Count.CountUp', array('countAlias' => 'Count'));

		$this->Count->name = 'Lorem ipsum dolor sit amet';
	}

/**
 * Method executed after each test
 *
 * @return void
 */
	public function endTest() {
		unset($this->Count);
		ClassRegistry::flush();
	}

/**
 * Testings saving of count
 *
 * @return void
 */
	public function testSaveCount() {
		$foreign_key = 1;

		$id = $this->Count->saveCount($foreign_key);
		$result = $this->Count->find('first', array(
			'conditions' => array(
				'Count.id' => $id,
			)
		));

		$this->assertEqual($result['Count']['model'], 'Lorem ipsum dolor sit amet');
		$this->assertEqual($result['Count']['foreign_key'], $foreign_key);
	}

	public function testGetTotalCount() {
		$result = $this->Count->getTotalCount('1');
		$expected = array('Count' => array('total_count' => 2));
		$this->assertEqual($result, $expected);

		$result = $this->Count->getTotalCount('1', array('Count.created >' => '2011-01-01 00:00:00'));
		$expected = array('Count' => array('total_count' => 1));
		$this->assertEqual($result, $expected);
	}

}
