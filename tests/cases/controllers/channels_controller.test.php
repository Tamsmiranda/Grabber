<?php
/* Channels Test cases generated on: 2011-05-29 17:05:48 : 1306689528*/
App::import('Controller', 'Channels');

class TestChannelsController extends ChannelsController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class ChannelsControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.channel');

	function startTest() {
		$this->Channels =& new TestChannelsController();
		$this->Channels->constructClasses();
	}

	function endTest() {
		unset($this->Channels);
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

}
?>