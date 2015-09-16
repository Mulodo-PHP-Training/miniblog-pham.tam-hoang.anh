<?php
/**
 *
 * Home controller
 * @author Tam Pham
 *
 */
class Controller_Home extends Controller_Base {
    public function action_index() {
        $this->template->title = 'Home';

        // array('title' => 'link')
        $breadcrumbs = array('Home' => Uri::base().'');
        $this->template->breadcrumbs = $breadcrumbs;
        $link_api = $this->link_api.'posts';
        $method   = 'GET';
        $data     = $this->curl($link_api, $method);
        $this->template->content = View::forge('home/index', $data);
    }
}