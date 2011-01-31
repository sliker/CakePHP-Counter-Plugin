<?php
/* Counts Test cases generated on: 2011-01-22 22:01:28 : 1295703388*/
App::import('Controller', 'Counts');

class TestCountsController extends CountsController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class CountsControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.count');

	function startTest() {
		$this->Counts =& new TestCountsController();
		$this->Counts->constructClasses();
	}

	function endTest() {
		unset($this->Counts);
		ClassRegistry::flush();
	}

	function testIndex() {

	}

	function testView() {

	}

	function testAdd() {

	}

	function testEdit() {

	}

	function testDelete() {

	}

	function testAdminIndex() {

	}

	function testAdminView() {

	}

	function testAdminAdd() {

	}

	function testAdminEdit() {

	}

	function testAdminDelete() {

	}

}
?>