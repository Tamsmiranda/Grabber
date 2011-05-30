<?php
/* Channel Test cases generated on: 2011-05-29 17:05:46 : 1306689526*/
App::import('Model', 'Channel');

class ChannelTestCase extends CakeTestCase {
	var $fixtures = array('app.channel');

	function startTest() {
		$this->Channel =& ClassRegistry::init('Channel');
	}

	function endTest() {
		unset($this->Channel);
		ClassRegistry::flush();
	}

}
?>