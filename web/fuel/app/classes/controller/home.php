<?php
class Controller_Home extends Controller_Base {
	public function action_index() {
		$this->template->title = 'Home';
		$this->template->content = View::forge('home/index');
	}
}