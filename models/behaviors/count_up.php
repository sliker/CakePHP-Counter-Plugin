<?php
/*
 * Count Plugin for CakePHP
 * 
 * PHP version 5
 *
 * @copyright Copyright 2010, Cake. (http://trpgtools-onweb.sourceforge.jp/)
 * @category Behavoir
 * @package  Count Plugin
 * @version  0.1
 * @author   Cake <cake_67@users.sourceforge.jp>
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link     https://github.com/Cake/CakePHP-Counter-Plugin
 */

class CountUpBehavior extends ModelBehavior {
/**
 * Settings
 * Sample: $setings = array(
 * 	'ModelName' => array(
 *		'SettingName' => 'value',
 *		...
 * 	)
 * );
 *
 * countAlias              - model alias for Counter model
 * foreignKey            - foreignKey used in the HABTM association
 *
 * @var array
 */
	public $setings = array(
	);

	protected $_defaults = array(
			'className' => 'Count',
			'foreignKey' => 'foreign_key',
			'conditions' => '',
			'fields' => array(
				'COUNT(DISTINCT `Count`.`id`) as `total_count`',
			),
			'order' => '',
			'limit' => null,
			'offset' => 0,
			'dependent' => true,
			'exclusive' => true,
			'finderQuery' => '',
	);

/**
 * Setup
 *
 * @param AppModel $Model
 * @param array $settings
 */
	public function setup(Model $Model, $settings = array()) {
		if (!isset($this->settings[$Model->alias])) {
			$this->settings[$Model->alias] = $this->_defaults;
		}
		$this->settings[$Model->alias] = array_merge(
			$this->settings[$Model->alias], 
			array(
				'countClass' => $Model->name,
				'conditions' => array(
					'Count.model' => $Model->name,
				),
			),
			$settings
		);

		// BindModel
		$Model->bindModel(
			array('hasMany' => array(
				'Count' => array(
					'className' => $this->settings[$Model->alias]['className'],
					'foreignKey' => $this->settings[$Model->alias]['foreignKey'],
					'conditions' => $this->settings[$Model->alias]['conditions'],
					'fields' => $this->settings[$Model->alias]['fields'],
					'order' => $this->settings[$Model->alias]['order'],
					'limit' => $this->settings[$Model->alias]['limit'],
					'offset' => $this->settings[$Model->alias]['offset'],
					'dependent' => $this->settings[$Model->alias]['dependent'],
					'exclusive' => $this->settings[$Model->alias]['exclusive'],
					'finderQuery' => $this->settings[$Model->alias]['finderQuery'],
				)
			))
		);
	}

/**
 * Saves a count
 */
	public function saveCount(Model $Model, $foreign_key = null) {
		$countModel = $Model->Count;

		if (empty($this->settings[$Model->alias]['countAlias'])) {
			return false;
		}

		$newCount[$this->settings[$Model->alias]['countAlias']] = array(
			'model' => $Model->name,
			'foreign_key' => $foreign_key,
			'host' => gethostbyaddr($_SERVER["REMOTE_ADDR"]),
		);

		$countModel->create();
		$countModel->save($newCount);

		return $countModel->id;
	}

/** 
 * Get total count By Foreign Key
 * 
 * param int $foreign_key
 * param array $conditions
 * 
 * return int $total_count
 */
	public function getTotalCount(Model $Model, $foreign_key = null, $conditions = array()) {
		$countModel = $Model->Count;

		$total_count = $this->_getTotalCount($Model, $foreign_key, $conditions);

		return array('Count' => array('total_count' => $total_count));
	}

	protected function _getTotalCount(Model $Model, $foreign_key = null, $conditions = array()) {
		$countModel = $Model->Count;

		$conditions = array(array(
			'model' => $Model->name,
			'foreign_key' => $foreign_key,
		), (array)$conditions);

		return $countModel->find('count', array(
			'conditions' => $conditions,
			'recursive' => -1,
		));
	}

}
