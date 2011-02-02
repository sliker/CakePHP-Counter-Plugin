<?php
/*
 * Count Plugin for CakePHP
 * 
 * PHP version 5
 *
 * @copyright Copyright 2010, Cake. (http://trpgtools-onweb.sourceforge.jp/)
 * @category HelperTest
 * @package  Count Plugin
 * @version  0.1
 * @author   Cake <cake_67@users.sourceforge.jp>
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link     https://github.com/Cake/CakePHP-Counter-Plugin
 */

App::import('Helper', array('Html', 'Count.Count'));
App::import('Behavior', 'Count.CountUp');

class CountModelTest extends CakeTestModel {
	public $useTable = 'counts';

	public $belongsTo = array();
	public $hasAndBelongsToMany = array();
	public $hasMany = array();
	public $hasOne = array();

	public $actsAs = array('Count.CountUp');
}


class CountTest extends CakeTestCase {
	public $plugin = 'count';
	public $Count = null;

	var $fixtures = array('plugin.count.count');

	public function startTest() {
		$this->Count = new CountHelper();
		$this->Count->Html = new HtmlHelper();

		$this->CountModel = ClassRegistry::init('Count');
		$this->CountModel->Behaviors->attach('Count.CountUp', array('countAlias' => 'Count'));

		$this->CountModel->name = 'Lorem ipsum dolor sit amet';
	}

/**
 * Simple Output of total count
 *
 * @return string
 */
	public function testSimpleOutputTotalCount() {
		$result = $this->CountModel->getTotalCount('1');

		$this->assertEqual('<span>2</span>', $this->Count->totalCount($result));

		$this->assertNotEqual('<span></span>', $this->Count->totalCount(array()));
	}

/**
 * Designed Output of total count
 *
 * @return string
 */
	public function testDesignedOutputTotalCount() {
		$result = $this->CountModel->getTotalCount('1');

		$this->assertEqual('<div>2</div>', $this->Count->totalCount($result, array('tag' => 'div')));

		$this->assertEqual('<div id="Id" class="ClassName">2</div>', $this->Count->totalCount($result, array('tag' => 'div', 'id' => 'Id', 'class' => 'ClassName')));

	}

/**
 * Method executed after each test
 *
 * @return void
 */
	public function endTest() {
		unset($this->Count);
		unset($this->CountModel);
		ClassRegistry::flush();
	}
}
