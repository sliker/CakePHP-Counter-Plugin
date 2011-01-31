<?php
/*
 * Counter Plugin for CakePHP
 * 
 * PHP version 5
 *
 * @copyright Copyright 2010, Cake. (http://trpgtools-onweb.sourceforge.jp/)
 * @category Fixture
 * @package  Counter Plugin
 * @version  0.1
 * @author   Cake <cake_67@users.sourceforge.jp>
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link     https://github.com/Cake/CakePHP-Counter-Plugin
 */

class CountFixture extends CakeTestFixture {
	var $name = 'Count';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10, 'key' => 'primary'),
		'model' => array('type' => 'string', 'null' => false, 'default' => NULL, 'key' => 'index', 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'foreign_key' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10),
		'host' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 64, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1), 'count_model' => array('column' => array('model', 'foreign_key'), 'unique' => 0), 'count_created' => array('column' => array('model', 'foreign_key', 'created'), 'unique' => 0)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

	var $records = array(
		array(
			'id' => 1,
			'model' => 'Lorem ipsum dolor sit amet',
			'foreign_key' => 1,
			'host' => 'Lorem ipsum dolor sit amet',
			'created' => '2011-01-22 22:35:29'
		),
		array(
			'id' => 2,
			'model' => 'Lorem ipsum dolor sit amet',
			'foreign_key' => 1,
			'host' => 'Lorem ipsum dolor sit amet2',
			'created' => '2010-01-22 22:35:29'
		),
		array(
			'id' => 3,
			'model' => 'Lorem ipsum dolor sit amet',
			'foreign_key' => 2,
			'host' => 'Lorem ipsum dolor sit amet',
			'created' => '2011-01-22 22:35:29'
		),
		array(
			'id' => 4,
			'model' => 'Lorem ipsum dolor sit amet2',
			'foreign_key' => 1,
			'host' => 'Lorem ipsum dolor sit amet',
			'created' => '2011-01-22 22:35:29'
		),
	);
}
?>