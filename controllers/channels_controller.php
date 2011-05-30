<?php
class ChannelsController extends AppController {

	var $name = 'Channels';

	function index() {
		$this->Channel->recursive = 0;
		$this->set('channels', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(sprintf(__('Invalid %s', true), 'channel'));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('channel', $this->Channel->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Channel->create();
			if ($this->Channel->save($this->data)) {
				$this->Session->setFlash(sprintf(__('The %s has been saved', true), 'channel'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(sprintf(__('The %s could not be saved. Please, try again.', true), 'channel'));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(sprintf(__('Invalid %s', true), 'channel'));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Channel->save($this->data)) {
				$this->Session->setFlash(sprintf(__('The %s has been saved', true), 'channel'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(sprintf(__('The %s could not be saved. Please, try again.', true), 'channel'));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Channel->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(sprintf(__('Invalid id for %s', true), 'channel'));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Channel->delete($id)) {
			$this->Session->setFlash(sprintf(__('%s deleted', true), 'Channel'));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(sprintf(__('%s was not deleted', true), 'Channel'));
		$this->redirect(array('action' => 'index'));
	}
}
?>