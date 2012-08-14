<?php
/*
 * Count Plugin for CakePHP
 * 
 * PHP version 5
 *
 * @copyright Copyright 2010, Cake. (http://trpgtools-onweb.sourceforge.jp/)
 * @category Helper
 * @package  Count Plugin
 * @version  0.1
 * @author   Cake <cake_67@users.sourceforge.jp>
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link     https://github.com/Cake/CakePHP-Counter-Plugin
 */

App::uses('AppHelper', 'View/Helper');
class CountHelper extends AppHelper {
	public $helpers = array('Html');

	public function totalCount($data, $options = array()) {

		$total_count = 0;
		if (isset($data['Count'][0]['Count'][0]['total_count']) && (is_string($data['Count'][0]['Count'][0]['total_count']) || is_int($data['Count'][0]['Count'][0]['total_count']))) {
			$total_count = $data['Count'][0]['Count'][0]['total_count'];
		} elseif (isset($data['Count']['total_count']) && (is_string($data['Count']['total_count']) || is_int($data['Count']['total_count']))) {
			$total_count = $data['Count']['total_count'];
		} else {
			return null;
		}

		if (isset($options['tag'])) {
			$name = $options['tag'];
			unset($options['tag']);
		} else {
			$name = 'span';
		}

		$options = array_merge(
			array(
				'id' => null,
				'class' => null,
			),
			(array)$options
		);

		return $this->Html->tag($name, $total_count, $options);
	}

}
