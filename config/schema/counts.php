<?php 
/*
 * Count Plugin for CakePHP
 * 
 * PHP version 5
 *
 * @copyright Copyright 2010, Cake. (http://trpgtools-onweb.sourceforge.jp/)
 * @category Schema
 * @package  Count Plugin
 * @version  0.1
 * @author   Cake <cake_67@users.sourceforge.jp>
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link     https://github.com/Cake/CakePHP-Counter-Plugin
 */

class CountsSchema extends CakeSchema {

/**
 * Name
 *
 * @var string
 * @access public
 */
	public $name = 'Counts';

/**
 * Before callback
 *
 * @param string Event
 * @return boolean
 * @access public
 */
	public function before($event = array()) {
		return true;
	}

/**
 * After callback
 *
 * @param string Event
 * @return boolean
 * @access public
 */
	public function after($event = array()) {
		return true;
	}

/**
 * Schema for count table
 *
 * @var array
 * @access public
 */
	var $counts = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10, 'key' => 'primary'),
		'model' => array('type' => 'string', 'null' => false, 'default' => NULL, 'key' => 'index', 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'foreign_key' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10),
		'host' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 64, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1), 'count_model' => array('column' => array('model', 'foreign_key'), 'unique' => 0), 'count_created' => array('column' => array('model', 'foreign_key', 'created'), 'unique' => 0)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci')
	);

}
